<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Comment;
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

class AdminController extends Controller {

    // admin dashboard page
    public function home(Request $request) {
        $admin_id = Auth::user()->id;
        if (request()->ajax()) {
            if ($request->start_date != '' && $request->end_date != '') {
                $data = DB::table('activities')
                        ->whereBetween('created_at', array($request->start_date, $request->end_date))
                        ->where('user_id', $admin_id)
                        ->orderBy('created_at', 'DESC')
                        ->get();
            } else {
                $data = DB::table('activities')
                        ->where('user_id', $admin_id)
                        ->orderBy('created_at', 'desc')
                        ->get();
            }
            return DataTables::of($data)->make(true);
        }
        return view('Admin.admin_dashboard');
    }

    // get all users on the users page
    public function users(Request $request) {
        $all_users = db::table('users')
                ->where('role', 'user')
                ->count();

        $active_users = db::table('users')
                ->where('role', 'user')
                ->where('user_status', 'Active')
                ->count();

        $cancelled_users = db::table('users')
                ->where('role', 'user')
                ->where('user_status', 'Cancelled')
                ->count();

        $verified_users = db::table('users')
                ->where('role', 'user')
                ->where('email_verified_at', '!=', '')
                ->count();

        $user_summary = [
            'all_users' => $all_users,
            'active_users' => $active_users,
            'cancelled_users' => $cancelled_users,
            'verified_users' => $verified_users
        ];

        if (request()->ajax()) {
            if ($request->start_date != '' && $request->end_date != '' && $request->select_user_type == 1) {
                $data = DB::table('users')
                        ->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->end_date)
                        ->where('role', 'user')
                        ->orderBy('created_at', 'desc')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->select_user_type == 2) {
                $data = DB::table('users')
                        ->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->end_date)
                        ->where('role', 'user')
                        ->where('user_status', 'Active')
                        ->orderBy('created_at', 'desc')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->select_user_type == 3) {
                $data = DB::table('users')
                        ->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->end_date)
                        ->where('role', 'user')
                        ->where('user_status', 'Suspend')
                        ->orderBy('created_at', 'desc')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->select_user_type == 4) {
                $data = DB::table('users')
                        ->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->end_date)
                        ->where('role', 'user')
                        ->where('email_verified_at', '!=', '')
                        ->orderBy('created_at', 'desc')
                        ->get();
            } else {
                $data = DB::table('users')
                        ->where('role', 'user')
                        ->orderBy('created_at', 'desc')
                        ->get();
            }
            return DataTables::of($data)
                            ->editColumn('created_at', function ($data) {
                                return date('j F, Y g:ia', strtotime($data->created_at));
                            })
                            ->addIndexColumn()
                            ->addColumn('edit', function ($data) {
                                $btn = '<button id="edit" data-id="' . $data->id . '" data-toggle="modal" data-target="#editUser"  class="form-control  confirm btn btn-info btn-sm">Edit</button>';
                                return $btn;
                            })
                            ->addColumn('view', function ($data) {
                                $btn = '<button id="viewUser" data-id="' . $data->id . '" data-toggle="modal" data-target="#userDetails"  class="form-control  confirm btn btn-info btn-sm">View</button>';
                                return $btn;
                            })
                            ->rawColumns(['edit', 'view'])
                            ->make(true);
        }
        return view('Admin.admin_all_users', ['user_summary' => $user_summary]);
    }

    // view each user details in modal on the users page
    public function viewUserDetails(Request $request) {
        $userInfo = user::where('id', $request->id)->first();

        $count_comment = db::table('comments')
                ->join('users', 'comments.user_id', '=', 'users.id')
                ->where('comments.user_id', $request->id)
                ->count();

        $count_likes = db::table('likes')
                ->join('users', 'likes.user_id', '=', 'users.id')
                ->where('likes.user_id', $request->id)
                ->count();

        $count_saved_post = db::table('favorites')
                ->join('users', 'favorites.user_id', '=', 'users.id')
                ->where('favorites.user_id', $request->id)
                ->count();

        if ($userInfo) {
            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "userInfo" => $userInfo,
                        "user_like" => $count_likes,
                        "user_favorite" => $count_saved_post,
                        "user_comment" => $count_comment,
            ]);
        } else {
            return response()->json([
                        'message' => "Internal Server Error",
                        "code" => 500,
                        "id" => $request->id
            ]);
        }
    }

    // get the a specific user's likes for likes table in modal of the users page
    public function userLikes(Request $request, $id) {
        $user_id = $id;
        if ($request->start_date != '' && $request->end_date != '') {
            $data = db::table('likes')
                    ->join('posts', 'likes.post_id', '=', 'posts.id')
                    ->join('users', 'posts.editor_id', '=', 'users.id')
                    ->where('likes.user_id', $user_id)
                    ->whereDate('likes.created_at', '>=', $request->start_date)
                    ->whereDate('likes.created_at', '<=', $request->end_date)
                    ->select('posts.featured_picture', 'posts.post_title', 'posts.created_at as post_created_at',
                            'likes.like_type', 'likes.created_at as likes_created_at')
                    ->orderBy('likes.created_at', 'desc')
                    ->get();
        } else {
            $data = db::table('likes')
                    ->join('posts', 'likes.post_id', '=', 'posts.id')
                    ->join('users', 'posts.editor_id', '=', 'users.id')
                    ->where('likes.user_id', $user_id)
                    ->select('posts.featured_picture', 'posts.post_title', 'posts.created_at as post_created_at',
                            'likes.like_type', 'likes.created_at as likes_created_at')
                    ->orderBy('likes.created_at', 'desc')
                    ->get();
        }
        return DataTables::of($data)
                        ->editColumn('post_created_at', function ($data) {
                            return date('j F, Y g:ia', strtotime($data->post_created_at));
                        })
                        ->editColumn('likes_created_at', function ($data) {
                            return date('j F, Y g:ia', strtotime($data->likes_created_at));
                        })
                        ->make(true);
    }

    // get the a specific user's favorite for favorite table in modal of the users page
    public function userFavorite(Request $request, $id) {
        $user_id = $id;
        if ($request->start_date != '' && $request->end_date != '') {
            $data = db::table('favorites')
                    ->join('posts', 'favorites.post_id', '=', 'posts.id')
                    ->join('users', 'posts.editor_id', '=', 'users.id')
                    ->where('favorites.user_id', $user_id)
                    ->whereDate('favorites.created_at', '>=', $request->start_date)
                    ->whereDate('favorites.created_at', '<=', $request->end_date)
                    ->select('posts.featured_picture', 'posts.post_title', 'posts.created_at as post_created_at',
                            'favorites.created_at as favorites_created_at')
                    ->orderBy('favorites.created_at', 'desc')
                    ->get();
        } else {
            $data = db::table('favorites')
                    ->join('posts', 'favorites.post_id', '=', 'posts.id')
                    ->join('users', 'posts.editor_id', '=', 'users.id')
                    ->where('favorites.user_id', $user_id)
                    ->select('posts.featured_picture', 'posts.post_title', 'posts.created_at as post_created_at',
                            'favorites.created_at as favorites_created_at')
                    ->orderBy('favorites.created_at', 'desc')
                    ->get();
        }
        return DataTables::of($data)
                        ->editColumn('post_created_at', function ($data) {
                            return date('j F, Y g:ia', strtotime($data->post_created_at));
                        })
                        ->editColumn('favorites_created_at', function ($data) {
                            return date('j F, Y g:ia', strtotime($data->favorites_created_at));
                        })
                        ->make(true);
    }

    // get the a specific user's comments and reply for comment table in modal of the users page
    public function userComment(Request $request, $id) {
        $user_id = $id;
        if ($request->start_date != '' && $request->end_date != '') {
            $data = db::table('comments')
                    ->join('posts', 'comments.post_id', '=', 'posts.id')
                    ->join('users', 'posts.editor_id', '=', 'users.id')
                    ->where('comments.user_id', $user_id)
                    ->whereDate('comments.created_at', '>=', $request->start_date)
                    ->whereDate('comments.created_at', '<=', $request->end_date)
                    ->select('posts.featured_picture', 'posts.post_title', 'posts.created_at as post_created_at',
                            'comments.comment_body', 'comments.comment_type', 'comments.created_at as comment_created_at')
                    ->orderBy('comments.created_at', 'desc')
                    ->get();
        } else {
            $data = db::table('comments')
                    ->join('posts', 'comments.post_id', '=', 'posts.id')
                    ->join('users', 'posts.editor_id', '=', 'users.id')
                    ->where('comments.user_id', $user_id)
                    ->select('posts.featured_picture', 'posts.post_title', 'posts.created_at as post_created_at',
                            'comments.comment_body', 'comments.comment_type', 'comments.created_at as comment_created_at')
                    ->orderBy('comments.created_at', 'desc')
                    ->get();
        }
        return DataTables::of($data)
                        ->editColumn('post_created_at', function ($data) {
                            return date('j F, Y g:ia', strtotime($data->post_created_at));
                        })
                        ->editColumn('comment_created_at', function ($data) {
                            return date('j F, Y g:ia', strtotime($data->comment_created_at));
                        })
                        ->make(true);
    }

    // code for getting a specific user's activity
    public function userActivity(Request $request, $id) {
        $user_id = $id;
        if ($request->start_date != '' && $request->end_date != '') {
            $data = DB::table('activities')
                    ->where('user_id', $user_id)
                    ->whereDate('created_at', '>=', $request->start_date)
                    ->whereDate('created_at', '<=', $request->end_date)
                    ->orderBy('created_at', 'DESC')
                    ->get();
        } else {
            $data = DB::table('activities')
                    ->where('user_id', $user_id)
                    ->orderBy('created_at', 'desc')
                    ->get();
        }
        return DataTables::of($data)
                        ->editColumn('created_at', function ($data) {
                            return date('j F, Y g:ia', strtotime($data->created_at));
                        })
                        ->make(true);
    }

    // get user id for editing user details
    public function editGetUserId(Request $request) {
        $result = user::where('id', $request->id)->first();
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

    // this handles the updating of users details on users page
    public function update(Request $request) {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'min:4', 'max:20'],
            'last_name' => ['required', 'string', 'min:4', 'max:20'],
            'phone' => ['numeric', 'digits_between:8,16', 'unique:users'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
                ]
        );
        $result = user::select()
                ->where('id', $request->id)
                ->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
        ]);
        $user_name = $data['first_name'] - $data['last_name'];
        $activity = new activity;
        $activity->user_id = Auth::user()->id;
        $activity->description = "Edited a user detail ($user_name)";
        $activity->save();

        if ($result) {
            return response()->json([
                        'message' => "Data Updated Successfully!",
                        "code" => 200,
            ]);
        }
    }

    // get all posts in post page
    public function all_posts(Request $request) {
        $count_all_post = db::table('posts')
                ->count();

        $count_approved_post = db::table('posts')
                ->where('status', 'Active')
                ->count();

        $count_pending_post = db::table('posts')
                ->where('status', 'Pending')
                ->count();

        $count_cancelled_post = db::table('posts')
                ->where('status', 'Cancel')
                ->count();

        $post_count_summary = [
            'all_post' => $count_all_post,
            'approved_post' => $count_approved_post,
            'pending_post' => $count_pending_post,
            'cancelled_post' => $count_cancelled_post
        ];

        if (request()->ajax()) {
            if ($request->start_date != '' && $request->end_date != '' && $request->all_post_type == 1) {
                $data = DB::table('users')
                        ->join('posts', 'users.id', '=', 'posts.editor_id')
                        ->whereDate('posts.created_at', '>=', $request->start_date)
                        ->whereDate('posts.created_at', '<=', $request->end_date)
                        ->select('posts.id', 'posts.featured_picture', 'posts.post_title', 'users.first_name',
                                'posts.category', 'posts.status', 'posts.created_at as post_created_at',
                                'posts.approved_by', 'posts.approved_at', 'posts.edited_at')
                        ->orderBy('posts.status', 'desc')
                        ->orderBy('posts.created_at', 'desc')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->all_post_type == 2) {
                $data = DB::table('users')
                        ->join('posts', 'users.id', '=', 'posts.editor_id')
                        ->whereDate('posts.created_at', '>=', $request->start_date)
                        ->whereDate('posts.created_at', '<=', $request->end_date)
                        ->where('posts.status', 'Active')
                        ->select('posts.id', 'posts.featured_picture', 'posts.post_title', 'users.first_name',
                                'posts.category', 'posts.status', 'posts.created_at as post_created_at',
                                'posts.approved_by', 'posts.approved_at', 'posts.edited_at')
                        ->orderBy('posts.status', 'desc')
                        ->orderBy('posts.created_at', 'desc')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->all_post_type == 3) {
                $data = DB::table('users')
                        ->join('posts', 'users.id', '=', 'posts.editor_id')
                        ->whereDate('posts.created_at', '>=', $request->start_date)
                        ->whereDate('posts.created_at', '<=', $request->end_date)
                        ->where('posts.status', 'Pending')
                        ->select('posts.id', 'posts.featured_picture', 'posts.post_title', 'users.first_name',
                                'posts.category', 'posts.status', 'posts.created_at as post_created_at',
                                'posts.approved_by', 'posts.approved_at', 'posts.edited_at')
                        ->orderBy('posts.status', 'desc')
                        ->orderBy('posts.created_at', 'desc')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->all_post_type == 4) {
                $data = DB::table('users')
                        ->join('posts', 'users.id', '=', 'posts.editor_id')
                        ->whereDate('posts.created_at', '>=', $request->start_date)
                        ->whereDate('posts.created_at', '<=', $request->end_date)
                        ->where('posts.status', 'Edit')
                        ->select('posts.id', 'posts.featured_picture', 'posts.post_title', 'users.first_name',
                                'posts.category', 'posts.status', 'posts.created_at as post_created_at',
                                'posts.approved_by', 'posts.approved_at', 'posts.edited_at')
                        ->orderBy('posts.status', 'desc')
                        ->orderBy('posts.created_at', 'desc')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->all_post_type == 5) {
                $data = DB::table('users')
                        ->join('posts', 'users.id', '=', 'posts.editor_id')
                        ->whereDate('posts.created_at', '>=', $request->start_date)
                        ->whereDate('posts.created_at', '<=', $request->end_date)
                        ->where('posts.status', 'Cancelled')
                        ->select('posts.id', 'posts.featured_picture', 'posts.post_title', 'users.first_name',
                                'posts.category', 'posts.status', 'posts.created_at as post_created_at',
                                'posts.approved_by', 'posts.approved_at', 'posts.edited_at')
                        ->orderBy('posts.status', 'desc')
                        ->orderBy('posts.created_at', 'desc')
                        ->get();
            } else {
                $data = DB::table('users')
                        ->join('posts', 'users.id', '=', 'posts.editor_id')
                        ->select('posts.id', 'posts.featured_picture', 'posts.post_title', 'users.first_name',
                                'posts.category', 'posts.status', 'posts.created_at as post_created_at',
                                'posts.approved_by', 'posts.approved_at', 'posts.edited_at')
                        ->orderBy('posts.status', 'desc')
                        ->orderBy('posts.created_at', 'desc')
                        ->get();
            }

            return DataTables::of($data)
                            ->editColumn('post_created_at', function ($data) {
                                return date('j F, Y g:ia', strtotime($data->post_created_at));
                            })
                            ->editColumn('approved_at', function ($data) {
                                if ($data->approved_at == '') {
                                    $newDate = '';
                                } else {
                                    $newDate = date('j F, Y g:ia', strtotime($data->approved_at));
                                }
                                return $newDate;
                            })
                            ->editColumn('edited_at', function ($data) {
                                if ($data->edited_at == '') {
                                    $newDate = '';
                                } else {
                                    $newDate = date('j F, Y g:ia', strtotime($data->edited_at));
                                }
                                return $newDate;
                            })
                            ->addIndexColumn()
                            ->addColumn('view', function ($data) {
                                $btn = '<button id="view" data-id="' . $data->id . '" data-toggle="modal" data-target="#viewPost"  class="form-control  confirm btn btn-info btn-sm">View</button>';
                                return $btn;
                            })
                            ->rawColumns(['view'])
                            ->make(true);
        }
        return view('Admin.admin_all_post', ['post_count_summary' => $post_count_summary]);
    }

    // view post on post page
    public function viewPost(Request $request) {
        $result = post::where('id', $request->id)->first();

        $count_likes = db::table('likes')
                ->join('posts', 'likes.post_id', '=', 'posts.id')
                ->where('posts.id', $request->id)
                ->count();

        $count_comments = db::table('comments')
                ->join('posts', 'comments.post_id', '=', 'posts.id')
                ->where('posts.id', $request->id)
                ->count();

        $count_favorite = db::table('favorites')
                ->join('posts', 'favorites.post_id', '=', 'posts.id')
                ->where('posts.id', $request->id)
                ->count();

        $count_page_view = db::table('page_views')
                ->join('posts', 'page_views.post_id', '=', 'posts.id')
                ->where('posts.id', $request->id)
                ->count();
        if ($result) {
            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "data" => $result,
                        "count_likes" => $count_likes,
                        "count_comments" => $count_comments,
                        "count_favorites" => $count_favorite,
                        "count_page_view" => $count_page_view
            ]);
        }
    }

    // take action on post in post page
    public function postAction(Request $request) {
        $data = $request->validate([
            'status' => ['required', 'string', 'min:2', 'max:20'],
            'id' => ['required']
        ]);
        $admin_id = Auth::user()->id;
        $updateP = db::table('posts')
                ->where('id', $data['id'])
                ->first();

        if ($updateP->approved_by == '') {
            $updatePost = db::table('posts')
                    ->where('id', $data['id'])
                    ->update([
                'approved_by_id' => $admin_id,
                'status' => $data['status'],
                'approved_by' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                'approved_at' => Carbon::now(),
            ]);

             
            $activity = new activity;
            $activity->user_id = $admin_id;
            $activity->description = "Action on new post ($updateP->post_title)";
            $activity->save();
        } else {
            $updatePost = db::table('posts')
                    ->where('id', $data['id'])
                    ->update([
                'status' => $data['status'],
            ]);
            $activity = new activity;
            $activity->user_id = $admin_id;
            $activity->description = "Action on an edited post ($updateP->post_title)";
            $activity->save();
        }

        $count_all_post = db::table('posts')
                ->count();

        $count_approved_post = db::table('posts')
                ->where('status', 'Active')
                ->count();

        $count_pending_post = db::table('posts')
                ->where('status', 'Pending')
                ->count();

        $count_cancelled_post = db::table('posts')
                ->where('status', 'Cancel')
                ->count();

        $post_count_summary = [
            'all_post' => $count_all_post,
            'approved_post' => $count_approved_post,
            'pending_post' => $count_pending_post,
            'cancelled_post' => $count_cancelled_post
        ];

        if ($data) {
            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "count" => $post_count_summary
            ]);
        }
    }

    // get all the comments on comment page
    public function all_comments(Request $request) {
        $count_all_comments = db::table('comments')
                ->count();

        $count_active_comment = db::table('comments')
                ->where('status', 'Active')
                ->count();

        $count_cancelled_comment = db::table('comments')
                ->where('status', 'Cancelled')
                ->count();

        if (request()->ajax()) {

            if ($request->start_date != '' && $request->end_date != '' && $request->select_comment_type == 1) {
                $data = DB::table('comments')
                        ->join('users', 'comments.user_id', '=', 'users.id')
                        ->join('posts', 'comments.post_id', '=', 'posts.id')
                        ->whereDate('comments.created_at', '>=', $request->start_date)
                        ->whereDate('comments.created_at', '<=', $request->end_date)
                        ->select('posts.id as post_id', 'posts.featured_picture', 'posts.post_title', 'posts.created_at as post_created_at',
                                'comments.comment_body', 'comments.comment_type', 'comments.status',
                                'users.first_name', 'comments.created_at', 'users.id as user_id',
                                'comments.id as comment_id')
                        ->orderBy('comments.created_at', 'desc')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->select_comment_type == 2) {
                $data = DB::table('comments')
                        ->join('users', 'comments.user_id', '=', 'users.id')
                        ->join('posts', 'comments.post_id', '=', 'posts.id')
                        ->whereDate('comments.created_at', '>=', $request->start_date)
                        ->whereDate('comments.created_at', '<=', $request->end_date)
                        ->where('comments.status', 'Active')
                        ->select('posts.id as post_id', 'posts.featured_picture', 'posts.post_title', 'posts.created_at as post_created_at',
                                'comments.comment_body', 'comments.comment_type', 'comments.status',
                                'users.first_name', 'comments.created_at', 'users.id as user_id',
                                'comments.id as comment_id')
                        ->orderBy('comments.created_at', 'desc')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->select_comment_type == 3) {
                $data = DB::table('comments')
                        ->join('users', 'comments.user_id', '=', 'users.id')
                        ->join('posts', 'comments.post_id', '=', 'posts.id')
                        ->whereDate('comments.created_at', '>=', $request->start_date)
                        ->whereDate('comments.created_at', '<=', $request->end_date)
                        ->where('comments.status', 'Cancelled')
                        ->select('posts.id as post_id', 'posts.featured_picture', 'posts.post_title', 'posts.created_at as post_created_at',
                                'comments.comment_body', 'comments.comment_type', 'comments.status',
                                'users.first_name', 'comments.created_at', 'users.id as user_id',
                                'comments.id as comment_id')
                        ->orderBy('comments.created_at', 'desc')
                        ->get();
            } else {
                $data = DB::table('comments')
                        ->join('users', 'comments.user_id', '=', 'users.id')
                        ->join('posts', 'comments.post_id', '=', 'posts.id')
                        ->select('posts.id as post_id', 'posts.featured_picture', 'posts.post_title', 'posts.created_at as post_created_at',
                                'comments.comment_body', 'comments.comment_type', 'comments.status',
                                'users.first_name', 'comments.created_at', 'users.id as user_id',
                                'comments.id as comment_id')
                        ->orderBy('comments.created_at', 'desc')
                        ->get();
            }
            return DataTables::of($data)
                            ->editColumn('post_created_at', function ($data) {
                                return date('j F, Y g:ia', strtotime($data->post_created_at));
                            })
                            ->editColumn('created_at', function ($data) {
                                return date('j F, Y g:ia', strtotime($data->created_at));
                            })
                            ->addIndexColumn()
                            ->addColumn('view', function ($data) {
                                $btn = '<button id="view" data-comment-id="' . $data->comment_id . '" data-post-id="' . $data->post_id . '" data-user-id="' . $data->user_id . '" data-toggle="modal" data-target="#viewComment"  class="form-control  confirm btn btn-info btn-sm">View ' . $data->comment_id . ' ' . $data->post_id . '</button>';
                                return $btn;
                            })
                            ->rawColumns(['view'])
                            ->make(true);
        }

        return view('Admin.admin_all_comments', ['count_all_comment' => $count_all_comments,
            'count_active_comment' => $count_active_comment, 'count_cancelled_comment' => $count_cancelled_comment]);
    }

    // view post on post page
    public function viewComment(Request $request) {
        $result = post::where('id', $request->post_id)->first();

        $count_comment_replies = db::table('comments')
                ->leftJoin('users', 'comments.user_id', '=', 'users.id')
                ->where('post_id', $request->post_id)
                ->where('comments.comment_type', '=', "Reply")
                ->where('parent_id', ">", 0)
                ->pluck('parent_id');

        $getParent = db::table('comments')
                ->where('id', $request->comment_id)
                ->pluck('parent_id');

        if ($getParent[0]) {
            $data = db::table('comments')
                    ->leftJoin('users', 'comments.user_id', '=', 'users.id')
                    ->where('post_id', $request->post_id)
                    ->where('comments.id', $getParent[0])
                    ->select('users.first_name', 'users.last_name', 'users.picture', 'comments.id',
                            'comments.user_id', 'comments.post_id', 'comments.comment_body',
                            'comments.created_at')
                    ->get();
        } else {
            $data = db::table('comments')
                    ->leftJoin('users', 'comments.user_id', '=', 'users.id')
                    ->where('post_id', $request->post_id)
                    ->where('comments.id', $request->comment_id)
                    ->select('users.first_name', 'users.last_name', 'users.picture', 'comments.id',
                            'comments.user_id', 'comments.post_id', 'comments.comment_body',
                            'comments.created_at')
                    ->get();
        }

        $count_likes = db::table('likes')
                ->join('posts', 'likes.post_id', '=', 'posts.id')
                ->where('posts.id', $request->post_id)
                ->count();

        $count_comments = db::table('comments')
                ->join('posts', 'comments.post_id', '=', 'posts.id')
                ->where('posts.id', $request->post_id)
                ->count();

        $count_favorite = db::table('favorites')
                ->join('posts', 'favorites.post_id', '=', 'posts.id')
                ->where('posts.id', $request->post_id)
                ->count();

        $count_page_view = db::table('page_views')
                ->join('posts', 'page_views.post_id', '=', 'posts.id')
                ->where('posts.id', $request->post_id)
                ->count();

        if ($result) {
            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "post_details" => $result,
                        "data" => $data,
                        "count_likes" => $count_likes,
                        "count_comments" => $count_comments,
                        "count_favorites" => $count_favorite,
                        "count_page_view" => $count_page_view,
                        "count_replies" => $count_comment_replies,
                        "comment_id" => $request->comment_id
            ]);
        }
    }

    // get all replies for view replies button on each comments in comment page  
    function getReply(Request $request) {
        $comment_id = $request->validate([
            'comment_id' => ['required', 'string', 'min:1', 'max:10000',]
                ]
        );
        $id = $request->id;
        $data = db::table('comments')
                ->leftJoin('users', 'comments.user_id', '=', 'users.id')
                ->where('comments.parent_id', $comment_id)
                ->select('users.first_name', 'users.last_name', 'users.picture', 'comments.id',
                        'comments.user_id', 'comments.parent_id as comment_id', 'comments.comment_name', 'comments.comment_body as reply_msg',
                        'comments.created_at')
                ->get();

        return response()->json([
                    'message' => 'success',
                    'data' => $data,
                    'id' => $id
        ]);
    }

    // get all likes in the likes page
    public function all_likes(Request $request) {
        $count_all_likes = db::table('likes')
                ->count();

        $count_likes_post = db::table('likes')
                ->where('like_type', 'Post')
                ->count();

        $count_likes_comment = db::table('likes')
                ->where('like_type', 'Comments')
                ->count();

        $like_count_summary = [
            'all_likes' => $count_all_likes,
            'post_likes' => $count_likes_post,
            'comment_likes' => $count_likes_comment,
        ];

        if (request()->ajax()) {
            if ($request->start_date != '' && $request->end_date != '' && $request->select_like_type == 1) {

                $data = DB::table('users')
                        ->join('posts', 'users.id', '=', 'posts.editor_id')
                        ->join('likes', 'posts.id', '=', 'likes.post_id')
                        ->whereDate('likes.created_at', '>=', $request->start_date)
                        ->whereDate('likes.created_at', '<=', $request->end_date)
                        ->select('posts.id', 'posts.post_title',
                                'users.first_name', 'users.last_name',
                                'likes.like_type', 'likes.created_at',
                                'likes.id as likes_id', 'users.id as users_id',)
                        ->orderBy('likes.created_at', 'DESC')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->select_like_type == 2) {

                $data = DB::table('users')
                        ->join('posts', 'users.id', '=', 'posts.editor_id')
                        ->join('likes', 'posts.id', '=', 'likes.post_id')
                        ->whereDate('likes.created_at', '>=', $request->start_date)
                        ->whereDate('likes.created_at', '<=', $request->end_date)
                        ->where('likes.like_type', 'Post')
                        ->select('posts.id', 'posts.post_title',
                                'users.first_name', 'users.last_name',
                                'likes.like_type', 'likes.created_at',
                                'likes.id as likes_id', 'users.id as users_id',)
                        ->orderBy('likes.created_at', 'DESC')
                        ->get();
            } else if ($request->start_date != '' && $request->end_date != '' && $request->select_like_type == 3) {

                $data = DB::table('users')
                        ->join('posts', 'users.id', '=', 'posts.editor_id')
                        ->join('likes', 'posts.id', '=', 'likes.post_id')
                        ->whereDate('likes.created_at', '>=', $request->start_date)
                        ->whereDate('likes.created_at', '<=', $request->end_date)
                        ->where('likes.like_type', 'Comment')
                        ->select('posts.id', 'posts.post_title',
                                'users.first_name', 'users.last_name',
                                'likes.like_type', 'likes.created_at',
                                'likes.id as likes_id', 'users.id as users_id',)
                        ->orderBy('likes.created_at', 'DESC')
                        ->get();
            } else {

                $data = DB::table('users')
                        ->join('posts', 'users.id', '=', 'posts.editor_id')
                        ->join('likes', 'posts.id', '=', 'likes.post_id')
                        ->select('posts.id', 'posts.post_title',
                                'users.first_name', 'users.last_name',
                                'likes.like_type', 'likes.created_at',
                                'likes.id as likes_id', 'users.id as users_id',)
                        ->orderBy('likes.created_at', 'DESC')
                        ->get();
            }

            return DataTables::of($data)
                            ->editColumn('created_at', function ($data) {
                                return date('j F, Y g:ia', strtotime($data->created_at));
                            })
                            ->addIndexColumn()
                            ->addColumn('view', function ($data) {
                                $btn = '<button id="view" data-id="' . $data->likes_id . '" data-toggle="modal" data-target="#viewPost"  class="form-control  confirm btn btn-info btn-sm">View ' . $data->likes_id . '</button>';
                                return $btn;
                            })
                            ->rawColumns(['view'])
                            ->make(true);
        }
        return view('Admin.admin_all_likes', ['like_count_summary' => $like_count_summary]);
    }

    // get more details on each likes in the likes page
    public function getLikeDetails(Request $request) {
        $getPost = db::table('likes')
                ->join('posts', 'likes.post_id', '=', 'posts.id')
                ->join('users', 'posts.editor_id', '=', 'users.id')
                ->where('likes.id', $request->id)
                ->select('posts.id', 'posts.post_title', 'posts.featured_picture', 'posts.body',
                        'posts.created_at', 'users.first_name', 'users.last_name')
                ->get();

        $count_likes = db::table('likes')
                ->where('post_id', $getPost[0]->id)
                ->count();

        if ($getPost) {
            return response()->json([
                        'message' => "Data Updated Successfully!",
                        "code" => 200,
                        "id" => $request->id,
                        "countLikes" => $count_likes,
                        "data" => $getPost,
            ]);
        } else {
            return response()->json([
                        'message' => "Internal Server Error",
                        "code" => 500,
            ]);
        }
    }

    // get all adverts in the advert page
    public function all_advert(Request $request) {
        return view('Admin.admin_all_advert');
    }

    // get all the admins on admin page
    public function all_admin(Request $request) {
        $sum_all_admin = db::table('users')
                ->where('role', '!=', 'user')
                ->count();

        $sum_all_adminitrator = db::table('users')
                ->where('role', 'admin')
                ->count();

        $sum_all_editor = db::table('users')
                ->where('role', 'editor')
                ->count();
        $sum_all_suspended_admin = db::table('users')
                ->where('role', '!=', 'user')
                ->where('user_status', 'suspended')
                ->count();

        if (request()->ajax()) {
            if ($request->start_date != '' && $request->end_date != '') {
                $data = DB::table('users')
                        ->whereBetween('created_at', array($request->start_date, $request->end_date))
                        ->where('role', 'user')
                        ->orderBy('created_at', 'DESC')
                        ->get();
            } else {
                $data = DB::table('users')
                        ->where('role', '!=', 'user')
                        ->orderBy('created_at', 'desc')
                        ->get();
            }
            return DataTables::of($data)
                            ->editColumn('created_at', function ($data) {
                                return date('j F, Y g:ia', strtotime($data->created_at));
                            })
                            ->addIndexColumn()
                            ->addColumn('edit', function ($data) {
                                $btn = '<button id="edit" data-id="' . $data->id . '" data-toggle="modal" data-target="#adminDetails"  class="form-control  confirm btn btn-info btn-sm">Edit</button>';
                                return $btn;
                            })
                            ->addColumn('view', function ($data) {
                                $btn = '<button id="view" data-id="' . $data->id . '" data-role="' . $data->role . '" data-toggle="modal" data-target="#adminDetails"  class="form-control  confirm btn btn-info btn-sm">View</button>';
                                return $btn;
                            })
                            ->rawColumns(['edit', 'view'])
                            ->make(true);
        }
        return view('Admin.admin_all_admin', ['sum_all_admin' => $sum_all_admin, 'sum_all_adminitrator' => $sum_all_adminitrator,
            'sum_all_editor' => $sum_all_editor, 'sum_all_suspended_admin' => $sum_all_suspended_admin]);
    }

    public function admin_details(Request $request) {
        $id = $request->id;
        $admin_details = db::table('users')
                ->where('id', $id)
                ->select('first_name', 'last_name', 'phone', 'email',
                        'role', 'picture', 'created_at')
                ->get();
        if ($request->role == 'editor') {
            $count_admin_all_post = db::table('users')
                    ->join('posts', 'users.id', '=', 'posts.editor_id')
                    ->where('posts.editor_id', $id)
                    ->count();
            $count_admin_approved_post = db::table('users')
                    ->join('posts', 'users.id', '=', 'posts.editor_id')
                    ->where('posts.editor_id', $id)
                    ->where('posts.status', 'Active')
                    ->count();
            $count_admin_pending_post = db::table('users')
                    ->join('posts', 'users.id', '=', 'posts.editor_id')
                    ->where('posts.editor_id', $id)
                    ->where('posts.status', 'Pending')
                    ->count();
            $count_admin_edit_post = db::table('users')
                    ->join('posts', 'users.id', '=', 'posts.editor_id')
                    ->where('posts.editor_id', $id)
                    ->where('posts.status', 'Edit')
                    ->count();
            $count_admin_cancelled_post = db::table('users')
                    ->join('posts', 'users.id', '=', 'posts.editor_id')
                    ->where('posts.editor_id', $id)
                    ->where('posts.status', 'Cancelled')
                    ->count();
        } else {
            $count_admin_all_post = db::table('users')
                    ->join('posts', 'users.id', '=', 'posts.editor_id')
                    ->where('posts.approved_by_id', $id)
                    ->count();
            $count_admin_approved_post = db::table('users')
                    ->join('posts', 'users.id', '=', 'posts.editor_id')
                    ->where('posts.approved_by_id', $id)
                    ->where('posts.status', 'Active')
                    ->count();
            $count_admin_pending_post = 0;

            $count_admin_edit_post = db::table('users')
                    ->join('posts', 'users.id', '=', 'posts.editor_id')
                    ->where('posts.approved_by_id', $id)
                    ->where('posts.status', 'Edit')
                    ->count();
            $count_admin_cancelled_post = db::table('users')
                    ->join('posts', 'users.id', '=', 'posts.editor_id')
                    ->where('posts.approved_by_id', $id)
                    ->where('posts.status', 'Cancelled')
                    ->count();
        }
        $count_post = [
            "count_admin_all_post" => $count_admin_all_post,
            "count_admin_approved_post" => $count_admin_approved_post,
            "count_admin_pending_post" => $count_admin_pending_post,
            "count_admin_edit_post" => $count_admin_edit_post,
            "count_admin_cancelled_post" => $count_admin_cancelled_post
        ];
        return response()->json([
                    'message' => "Internal Server Error",
                    "code" => $id,
                    "admin_details" => $admin_details,
                    "getAdminCountPost" => $count_post
        ]);
    }

    // add a new admin on admin page
    public function add_admin(Request $request) {
        $data = $request->validate(
                [
                    'first_name' => ['required', 'string', 'min:2', 'max:20'],
                    'last_name' => ['required', 'string', 'min:2', 'max:20'],
                    'phone' => ['required', 'numeric', 'digits_between:8,16', 'unique:users'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'picture' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:6000'],
                    'role' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:3', 'confirmed'],
                ],
                [
                    'email.unique' => 'The email address is taken',
                ]
        );
        $ran = substr(str_shuffle("123456789abcdefghijklmnopqrstuvwxyz"), 0, 4);

        $image = $ran . time() . '.' . $data['picture']->extension();
        $data['picture']->move(public_path('images'), $image);

        $new_user = new User;
        $new_user->first_name = $data['first_name'];
        $new_user->last_name = $data['last_name'];
        $new_user->phone = $data['phone'];
        $new_user->username = $data['last_name'];
        $new_user->role = $data['role'];
        $new_user->picture = $image;
        $new_user->user_status = 'Active';
        $new_user->email_verified_at = date('Y-m-d H:i:s');
        $new_user->email = $data['email'];
        $new_user->password = Hash::make($data['password']);
        $new_user->save();

        if ($data['first_name']) {
            return response()->json([
                        'message' => "Data Updated Successfully!",
                        "code" => 200,
                        "id" => $data['first_name']
            ]);
        } else {
            return response()->json([
                        'message' => "Internal Server Error",
                        "code" => 500,
                        "id" => $data['first_name']
            ]);
        }
    }

    // view admin details on admin page
    // 
    public function user_details(Request $request) {

        return view('Admin.admin_user_details');
    }

    // change admin password
    public function change_password(Request $request) {
        $data = $request->validate([
            'password' => ['required', 'string', 'min:3', 'confirmed'],
                ]
        );

        $admin_id = Auth::user()->id;
        $users = User::select()
                ->where('id', '=', $admin_id)
                ->update(['password' => Hash::make($data['password'])]);

        $activity = new activity;
        $activity->user_id = $admin_id;
        $activity->description = "Changed password";
        $activity->save();

        return response()->json([
                    'message' => "Data Found",
                    "code" => 200,
        ]);
    }

}
