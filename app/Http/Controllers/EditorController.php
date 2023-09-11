<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Likes;
use App\Models\Favorite;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use App\Notifications\UserChanges;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Activity;
use Image;

class EditorController extends Controller {

    // code for editor dashboard (code for summaries, and post table)
    public function dashboard(Request $request) {
        $editor_id = Auth::user()->id;
        $count_all_post = db::table('posts')
                ->where('editor_id', $editor_id)
                ->count();

        $count_approved_post = db::table('posts')
                ->where('status', 'Active')
                ->where('editor_id', $editor_id)
                ->count();

        $count_pending_post = db::table('posts')
                ->where('status', 'Pending')
                ->where('editor_id', $editor_id)
                ->count();

        $count_cancelled_post = db::table('posts')
                ->where('status', 'Cancel')
                ->where('editor_id', $editor_id)
                ->count();

        $count_edit_post = db::table('posts')
                ->where('status', 'Edit')
                ->where('editor_id', $editor_id)
                ->count();

        $count_likes = db::table('likes')
                ->join('posts', 'likes.post_id', '=', 'posts.id')
                ->where('posts.editor_id', $editor_id)
                ->count();

        $count_comments = db::table('comments')
                ->join('posts', 'comments.post_id', '=', 'posts.id')
                ->where('posts.editor_id', $editor_id)
                ->count();

        $post_count_summary = [
            'all_post' => $count_all_post,
            'approved_post' => $count_approved_post,
            'pending_post' => $count_pending_post,
            'cancelled_post' => $count_cancelled_post,
            'edit_post' => $count_edit_post,
            'likes' => $count_likes,
            'comments' => $count_comments,
        ];

        if (request()->ajax()) {

            if ($request->start_date != '' && $request->end_date != '' && $request->select_post_type == 1) {
                $data = DB::table('posts')
                        ->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->end_date)
                        ->where('editor_id', $editor_id)
                        ->orderBy('created_at', 'DESC')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->select_post_type == 2) {
                $data = DB::table('posts')
                        ->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->end_date)
                        ->where('editor_id', $editor_id)
                        ->where('status', 'Active')
                        ->orderBy('created_at', 'DESC')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->select_post_type == 3) {
                $data = DB::table('posts')
                        ->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->end_date)
                        ->where('editor_id', $editor_id)
                        ->where('status', 'Pending')
                        ->orderBy('created_at', 'DESC')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->select_post_type == 4) {
                $data = DB::table('posts')
                        ->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->end_date)
                        ->where('editor_id', $editor_id)
                        ->where('status', 'Edit')
                        ->orderBy('created_at', 'DESC')
                        ->get();
            } else {
                $data = DB::table('posts')
                        ->where('editor_id', $editor_id)
                        ->orderBy('status', 'DESC')
                        ->orderBy('created_at', 'desc')
                        ->get();
            }
            return DataTables::of($data)
                            ->editColumn('created_at', function ($data) {
                                return date('F j, Y, g:ia', strtotime($data->created_at));
                            })
                            ->addIndexColumn()
                            ->addColumn('edit', function ($data) {
                                if ($data->status == 'Edit') {
                                    $btn = '<button id="edit" data-id="' . $data->id . '" data-toggle="modal" data-target="#editPostModal"  class="form-control  confirm btn btn-info btn-sm ">Edit</button>';
                                } else {
                                    $btn = '<button id="edit" data-id="' . $data->id . '" data-toggle="modal" data-target="#editorPostModal"  class="form-control d-none  confirm btn btn-info btn-sm">Edit2</button>';
                                }
                                return $btn;
                            })
                            ->addColumn('view', function ($data) {
                                $btn1 = '<button id="view" data-id="' . $data->id . '" data-toggle="modal" data-target="#viewPost"  class="form-control  confirm btn btn-info btn-sm">View</button>';
                                return $btn1;
                            })
//                            ->filter(function ($instance) use ($request){
//                                if($request->search == '2'){
//                                    $instance->where('status', 'Active');
//                                }
//                                else  if($request->select_post_type == '3'){
//                                    $instance->where('status', 'Pending');
//                                }
//                            })
                            ->rawColumns(['edit', 'view'])
                            ->make(true);
        }
        return view('editor.editor_dashboard', ['post_count_summary' => $post_count_summary]);
    }

   
    // code for retrieving data for editor's activities
    public function editorActivity(Request $request) {
        $editor_id = Auth::user()->id;
        if (request()->ajax()) {
            if ($request->start_date != '' && $request->end_date != '') {
                $data = DB::table('activities')
                        ->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->end_date)
                        ->where('user_id', $editor_id)
                        ->orderBy('created_at', 'DESC')
                        ->get();
            } else {
                $data = DB::table('activities')
                        ->where('user_id', $editor_id)
                        ->orderBy('created_at', 'desc')
                        ->get();
            }

            return DataTables::of($data)->editColumn('created_at', function ($data) {
                        return date('F j, Y g:ia', strtotime($data->created_at));
                    })->make(true);
        }
    }

    // code for creating a new post
    public function storePost(Request $request) {
        $data = $request->validate(
                [
                    'watermark' => ['required'],
                    'post_title' => ['required', 'string', 'min:15', 'max:200'],
                    'feature_picture' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:8000'],
                    'post_body' => ['required', 'string', 'min:30', 'max:60000'],
                    'category' => ['required', 'string', 'min:3', 'max:20'],
                ]
        );

        if ($data['watermark'] == 'yes') {
            $editor_id = Auth::user()->id;
            $ran = substr(str_shuffle("123456789abcdefghijklmnopqrstuvwxyz"), 0, 4);
            $image_name = $ran . time() . '.' . $data['feature_picture']->extension();
            $image_resize = Image::make($data['feature_picture']->getRealPath());
            $image_resize->resize(500, 500);
            $watermark = Image::make(public_path('images/logo1.png'))->opacity(30);
            $watermark->resize(600, 150);
            $image_resize->insert($watermark, 'center');
            $image_resize->save(public_path('images/') . $image_name);

            $post = new post;
            $post->post_title = $data['post_title'];
            $post->featured_picture = $image_name;
            $post->body = $data['post_body'];
            $post->editor_id = $editor_id;
            $post->category = $data['category'];
            $post->status = 'Pending';
            $post->watermark = 'Yes';
            $post->save();

            $post_title = $data['post_title'];
            $activity = new activity;
            $activity->user_id = $editor_id;
            $activity->description = "Created a post ($post_title)";
            $activity->save();
        } else {
            $editor_id = Auth::user()->id;
            $ran = substr(str_shuffle("123456789abcdefghijklmnopqrstuvwxyz"), 0, 4);
            $image_name = $ran . time() . '.' . $data['feature_picture']->extension();
            $image_resize = Image::make($data['feature_picture']->getRealPath());
            $image_resize->resize(500, 500);
            $image_resize->save(public_path('images/') . $image_name);

            $post = new post;
            $post->post_title = $data['post_title'];
            $post->featured_picture = $image_name;
            $post->body = $data['post_body'];
            $post->editor_id = $editor_id;
            $post->category = $data['category'];
            $post->status = 'Pending';
            $post->watermark = 'No';
            $post->save();

            $post_title = $data['post_title'];
            $activity = new activity;
            $activity->user_id = $editor_id;
            $activity->description = "Created a post ($post_title)";
            $activity->save();
        }


        $count_all_post = db::table('posts')
                ->where('editor_id', Auth::user()->id)
                ->count();

        $count_approved_post = db::table('posts')
                ->where('status', 'Active')
                ->where('editor_id', Auth::user()->id)
                ->count();

        $count_pending_post = db::table('posts')
                ->where('status', 'Pending')
                ->where('editor_id', Auth::user()->id)
                ->count();

        $count_cancelled_post = db::table('posts')
                ->where('status', 'Cancel')
                ->where('editor_id', Auth::user()->id)
                ->count();

        $count_edit_post = db::table('posts')
                ->where('status', 'Edit')
                ->where('editor_id', Auth::user()->id)
                ->count();

        $count_likes = db::table('likes')
                ->join('posts', 'likes.post_id', '=', 'posts.id')
                ->where('posts.editor_id', Auth::user()->id)
                ->count();

        $post_count_summary = [
            'all_post' => $count_all_post,
            'approved_post' => $count_approved_post,
            'pending_post' => $count_pending_post,
            'cancelled_post' => $count_cancelled_post,
            'edit_post' => $count_edit_post,
            'likes' => $count_likes,
        ];

        return response()->json([
                    'message' => "Data Updated Successfully!",
                    "code" => 200,
                    "data" => $post_count_summary
        ]);
    }

    // code for editing each post
    public function editPost(Request $request) {
        $data = $request->validate(
                ['post_id' => ['required'],
                    'watermark' => ['required'],
                    'feature_picture' => ['image', 'mimes:png,jpg,jpeg', 'max:8000'],
                    'post_title' => ['required', 'string', 'min:15', 'max:200'],
                    'post_body' => ['required', 'string', 'min:30', 'max:60000'],
                    'category' => ['required', 'string', 'min:3', 'max:20'],
                ]
        );
        $editor_id = Auth::user()->id;
          $current_timestamp = Carbon::now()->toDateTimeString();
        if (is_null($request->feature_picture)) {
            post::select()
                    ->where('id', '=', $data['post_id'])
                    ->update(['post_title' => $data['post_title'], 'body' => $data['post_body'],
                        'category' => $data['category'], 'status' => 'Pending', 'edited_at' => $current_timestamp]);

            $post_title = $data['post_title'];
            $activity = new activity;
            $activity->user_id = $editor_id;
            $activity->description = "Edited a post ($post_title)";
            $activity->save();
        } else {
            if ($data['watermark'] == 'Yes') {
                $ran = substr(str_shuffle("123456789abcdefghijklmnopqrstuvwxyz"), 0, 4);
                $image_name = $ran . time() . '.' . $data['feature_picture']->extension();
                $image_resize = Image::make($data['feature_picture']->getRealPath());
                $image_resize->resize(500, 500);
                $watermark = Image::make(public_path('images/logo1.png'))->opacity(30);
                $watermark->resize(600, 150);
                $image_resize->insert($watermark, 'center');
                $image_resize->save(public_path('images/') . $image_name);

                post::select()
                        ->where('id', '=', $data['post_id'])
                        ->update(['post_title' => $data['post_title'], 'body' => $data['post_body'],
                            'category' => $data['category'], 'watermark' => 'Yes',
                            'status' => 'Pending', 'featured_picture' => $image_name, 'edited_at' => $current_timestamp]);

                $post_title = $data['post_title'];
                $activity = new activity;
                $activity->user_id = $editor_id;
                $activity->description = "Edited a post ($post_title)";
                $activity->save();
            } else {
                $editor_id = Auth::user()->id;
                $ran = substr(str_shuffle("123456789abcdefghijklmnopqrstuvwxyz"), 0, 4);
                $image_name = $ran . time() . '.' . $data['feature_picture']->extension();
                $image_resize = Image::make($data['feature_picture']->getRealPath());
                $image_resize->resize(500, 500);
                $image_resize->save(public_path('images/') . $image_name);

                post::select()
                        ->where('id', '=', $data['post_id'])
                        ->update(['post_title' => $data['post_title'], 'body' => $data['post_body'],
                            'category' => $data['category'], 'watermark' => 'No',
                            'status' => 'Pending', 'featured_picture' => $image_name, 'edited_at' => $current_timestamp]);

                $post_title = $data['post_title'];
                $activity = new activity;
                $activity->user_id = $editor_id;
                $activity->description = "Edited a post ($post_title)";
                $activity->save();
            }
        }


        $count_all_post = db::table('posts')
                ->where('editor_id', Auth::user()->id)
                ->count();

        $count_approved_post = db::table('posts')
                ->where('status', 'Active')
                ->where('editor_id', Auth::user()->id)
                ->count();

        $count_pending_post = db::table('posts')
                ->where('status', 'Pending')
                ->where('editor_id', Auth::user()->id)
                ->count();

        $count_cancelled_post = db::table('posts')
                ->where('status', 'Cancel')
                ->where('editor_id', Auth::user()->id)
                ->count();

        $count_edit_post = db::table('posts')
                ->where('status', 'Edit')
                ->where('editor_id', Auth::user()->id)
                ->count();

        $count_likes = db::table('likes')
                ->join('posts', 'likes.post_id', '=', 'posts.id')
                ->where('posts.editor_id', Auth::user()->id)
                ->count();

        $post_count_summary = [
            'all_post' => $count_all_post,
            'approved_post' => $count_approved_post,
            'pending_post' => $count_pending_post,
            'cancelled_post' => $count_cancelled_post,
            'edit_post' => $count_edit_post,
            'likes' => $count_likes,
        ];

        return response()->json([
                    'message' => "Data Updated Successfully!",
                    "code" => 200,
                    "data" => $post_count_summary
        ]);
    }

    // code for viewing each post from the datatable
    public function viewPost(Request $request) {
        $result = post::where('id', $request->id)->first();

        $count_likes = db::table('likes')
                ->join('posts', 'likes.post_id', '=', 'posts.id')
                ->where('posts.editor_id', Auth::user()->id)
                ->where('posts.id', $request->id)
                ->count();

        $count_favorite = db::table('favorites')
                ->join('posts', 'favorites.post_id', '=', 'posts.id')
                ->where('posts.editor_id', Auth::user()->id)
                ->where('posts.id', $request->id)
                ->count();

        $count_comment = db::table('comments')
                ->join('posts', 'comments.post_id', '=', 'posts.id')
                ->where('posts.editor_id', Auth::user()->id)
                ->where('posts.id', $request->id)
                ->count();

        $count_views = db::table('page_views')
                ->join('posts', 'page_views.post_id', '=', 'posts.id')
                ->where('page_views.post_id', $request->id)
                ->count();

        if ($result) {
            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "data" => $result,
                        "count_likes" => $count_likes,
                        "count_favorites" => $count_favorite,
                        "count_comment" => $count_comment,
                        "count_view" => $count_views
            ]);
        } else {
            return response()->json([
                        'message' => "Internal Server Error",
                        "code" => 500,
            ]);
        }
    }

    // code for getting the id of each post in order to view or edit the said post
    public function getPostId(Request $request) {
        $result = post::where('id', $request->id)->first();

        if ($result) {
            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "data" => $result,
            ]);
        } else {
            return response()->json([
                        'message' => "Internal Server Error",
                        "code" => 500,
                        "id" => $request->id
            ]);
        }
    }

    // code for changing editor's password
    public function change_password(Request $request) {
        $data = $request->validate([
            'password' => ['required', 'string', 'min:3', 'confirmed'],
                ]
        );

        $editor = Auth::user()->id;

        User::select()
                ->where('id', '=', $editor)
                ->update(['password' => Hash::make($data['password'])]);

        $activity = new activity;
        $activity->user_id = $editor;
        $activity->description = "Changed password";
        $activity->save();

        return response()->json([
                    'message' => "Data Found",
                    "code" => 200,
        ]);
    }

}
