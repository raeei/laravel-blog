<?php

namespace App\Http\Controllers;

//use Illuminate\Notifications\Notifiable;
//use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Likes;
use App\Models\Favorite;
use App\Models\Post;
use App\Models\newsletterSubscription;
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
use App\Helpers\UserSystemInfoHelper;
use Stevebauman\Location\Facades\Location;
use Browser;
use File;
use Mail;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    // for the homepage (welcome page) of the website
    public function home() {
        $get_all_post = DB::table('posts')
                ->join('users', 'posts.editor_id', '=', 'users.id')
                ->where('posts.status', 'Active')
                ->select('users.first_name', 'users.last_name', 'posts.status', 'posts.id', 'posts.post_title',
                        'posts.featured_picture', 'posts.body', 'posts.editor_id', 'posts.approved_by',
                        'posts.category')
                ->orderBy('posts.created_at', 'DESC')
                ->get();

        $post = $get_all_post->where('category', 'Politics')->take(6);

        $sidebar_post1 = $get_all_post
                ->where('category', '!=', ['Sport', 'Entertainment', 'Politics', 'News'])
                ->take(6);

        $sport = $get_all_post
                ->where('category', 'Sport')
                ->take(4);

        $news = $get_all_post
                ->where('category', 'News')
                ->take(4);

        $business = $get_all_post
                ->where('category', 'Business')
                ->take(10);

        $last_sect = $get_all_post
                ->where('category', '!=', ['Sport', 'Business', 'Technology', 'Entertainment', 'Politics', 'News'])
                ->take(6);

        if (Auth::check()) {
            if (Auth()->user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth()->user()->role == 'moderator') {
                return redirect()->route('admin.all_advert');
            } elseif (Auth()->user()->role == 'editor') {
                return redirect()->route('editor.dashboard');
            } elseif (Auth()->user()->role == 'user') {
                return view('welcome', ['posts' => $post, 'sidebar_post1' => $sidebar_post1,
                    'sport' => $sport, 'news' => $news, 'business' => $business,
                    'last_sect' => $last_sect]);
            }
        } else {

            return view('welcome', ['posts' => $post, 'sidebar_post1' => $sidebar_post1,
                'sport' => $sport, 'news' => $news, 'business' => $business,
                'last_sect' => $last_sect]);
        }
    }
    
    
    public function network(Request $request) {
        return response()->json([
                        'message' => "Successful",
                        "code" => 200,
            ]);
    }

    // for searching the blog for a particular post
    public function search_post(Request $request) {
        $search_input = \request()->query(key: 'query');
        $search = DB::table('posts')
                ->where('post_title', 'LIKE', "%{$search_input}%")
                ->select('id', 'post_title',
                        'featured_picture', 'body',
                        'category')
                ->orderBy('created_at', 'DESC')
                ->simplePaginate(4);

        $pluck_search_post_id = $search->pluck('id');

        $side_bar = DB::table('posts')
                ->whereNotIn('id', $pluck_search_post_id)
                ->select('id', 'post_title',
                        'featured_picture', 'body',
                        'category')
                ->inRandomOrder()
                ->orderBy('created_at', 'DESC')
                ->simplePaginate(8);

        $pluck_side_post_id = $side_bar->pluck('id');

        $bottom_post = DB::table('posts')
                ->whereNotIn('id', $pluck_search_post_id)
                ->whereNotIn('id', $pluck_side_post_id)
                ->select('id', 'post_title',
                        'featured_picture', 'body',
                        'category')
                ->inRandomOrder()
                ->orderBy('created_at', 'DESC')
                ->paginate(4);

        if ($search_input && strlen($search_input) > 0) {
            return view('post_search', ['searched_post' => $search, 'search_input' => $search_input,
                'bottom_post' => $bottom_post, 'side_bar' => $side_bar]);
        } else {
            return abort(404);
        }
    }

    // for viewing user's favorite post
    public function favoritePost() {
        $user_id = Auth::user()->id;
        $favorite = DB::table('posts')
                ->join('favorites', 'posts.id', '=', 'favorites.post_id')
                ->join('users', 'posts.editor_id', '=', 'users.id')
                ->where('favorites.user_id', $user_id)
                ->select('favorites.created_at as favorites_created_at', 'posts.id as post_id',
                        'posts.post_title', 'posts.featured_picture', 'posts.body',
                        'posts.category', 'posts.created_at as post_created_at',
                        'users.first_name', 'users.last_name')
                ->simplePaginate(4);

        $favorites = DB::table('posts')
                ->join('favorites', 'posts.id', '=', 'favorites.post_id')
                ->join('users', 'posts.editor_id', '=', 'users.id')
                ->where('favorites.user_id', $user_id)
                ->select('posts.id as post_id')
                ->pluck('post_id');

        $sport = DB::table('posts')
                ->join('users', 'posts.editor_id', '=', 'users.id')
                ->where('posts.status', 'Active')
                ->inRandomOrder()
                ->whereNotIn('posts.id', $favorites)
                ->select('posts.id', 'posts.featured_picture', 'posts.post_title', 'posts.body', 'users.first_name', 'users.last_name')
                ->paginate(8);

        $post = DB::table('posts')
                ->where('posts.status', 'Active')
                ->whereNotIn('posts.id', $favorites)
                ->paginate(8);
        return view('saved_post', ['favorites' => $favorite, 'posts' => $post, 'sport' => $sport]);
    }

    // code for reading(viewing) a post
    public function postPage(Request $request, $post_name, $id) {
        $get_all_post = db::table('users')
                ->join('posts', 'posts.editor_id', '=', 'users.id')
                ->select('posts.id', 'posts.post_title', 'posts.category', 'posts.featured_picture', 'posts.body', 'posts.status',
                        'posts.created_at', 'users.first_name', 'users.last_name', 'users.picture')
                ->inRandomOrder()
                ->orderBy('created_at', 'DESC')
                ->get();

        $singlePost = $get_all_post
                        ->where('id', $id)->first();

        $related_post = $get_all_post
                ->where('id', '!=', $id)
                ->take(10);

        $bottom_post = $get_all_post
                ->where('id', '!=', $id)
                ->where('category', '!=', ['Entertainment', 'Politics', 'News'])
                ->take(12);

        $current_timestamp = Carbon::now()->toDateTimeString();
        db::insert('insert into page_views (post_id, created_at, updated_at) values (?,?,?)', [$id, $current_timestamp, $current_timestamp]);
        return view('post_page', ['singlePost' => $singlePost, 'related_post' => $related_post, 'bottom_post' => $bottom_post]);
    }

    // for creating a comment on a particular post
    public function createComment(Request $request) {
        $data = $request->validate([
            'id' => ['required'],
            'post_comment' => ['required', 'string', 'min:15', 'max:10000',],
                ]
        );
        $user_id = Auth::user()->id;
        
        $post_title = db::table('posts')
                ->where('id', $data['id'])
                ->select('post_title')
                ->pluck('post_title');

        $comment = new comment;
        $comment->user_id = $user_id;
        $comment->post_id = $data['id'];
        $comment->comment_body = $data['post_comment'];
        $comment->comment_type = "Comment";
        $comment->save();

        $activity = new activity;
        $activity->user_id = $user_id;
        $activity->description = "Commented on a post ($post_title[0])";
        $activity->save();

            return response()->json([
                        'message' => "Successful",
                        "code" => 200,
                        "data" => $data['id'],
            ]);
    }

    // to get all the comments on a particular post, this excludes the replies on the comments
    function getAllComment(Request $request, $id) {
        $comments_users_table = db::table('comments')
                ->leftJoin('users', 'comments.user_id', '=', 'users.id')
                ->where('comments.post_id', $id)
                ->select('users.first_name', 'users.last_name', 'users.picture', 'comments.id',
                        'comments.user_id', 'comments.post_id', 'comments.comment_body',
                        'comments.comment_type', 'comments.parent_id', 'comments.created_at')
                ->get();

        $data = $comments_users_table
                ->where('comment_type', '=', "Comment");

        $count_comment_replies = $comments_users_table
                ->where('comment_type', '=', "Reply")
                ->where('parent_id', ">", 0)
                ->pluck('parent_id');

        $likes_table = db::table('likes')
                ->where('like_type', '=', 'Comment')
                ->where('post_id', $id)
                ->get();
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = 0;
        }

        $likes_comment_id = $likes_table->pluck('comment_id');
        $loggedIn_user_likes = $likes_table->where('user_id', $user_id)->pluck('comment_id');
//        $like_user_id = $likes_table->pluck('user_id');

        return response()->json([
                    'message' => 'success',
                    'data' => $data,
                    'count_replies' => $count_comment_replies,
                    'count_comment_likes' => $likes_comment_id,
                    'loggedIn_user_likes' => $loggedIn_user_likes,
                    'like_table' => $likes_table 
        ]);
    }

    // for replying a comment on a post
    function replyComment(Request $request) {
        $data = $request->validate([
            'post_id' => ['required'],
            'comment_name' => [],
            'comment_id' => ['required', 'string', 'min:1', 'max:10000',],
            'reply_msg' => ['required', 'string', 'min:15', 'max:10000',],            ]
        );

        $user_id = Auth::user()->id;

        $post_title = db::table('posts')
                ->where('id', $data['post_id'])
                ->select('post_title')
                ->pluck('post_title');

        if ($data['comment_name'] == '') {
            $comment = new comment;
            $comment->user_id = $user_id;
            $comment->post_id = $data['post_id'];
            $comment->parent_id = $data['comment_id'];
            $comment->comment_name = " ";
            $comment->comment_body = $data['reply_msg'];
            $comment->comment_type = "Reply";
            $comment->status = "Active";
            $comment->save();

            $activity = new activity;
            $activity->user_id = $user_id;
            $activity->description = "Replied a comment on a post ($post_title[0])";
            $activity->save();
        } 
        else {
            $comment = new comment;
            $comment->user_id = $user_id;
            $comment->post_id = $data['post_id'];
            $comment->parent_id = $data['comment_id'];
            $comment->comment_name = $data['comment_name'];
            $comment->comment_body = $data['reply_msg'];
            $comment->comment_type = "Reply";
            $comment->status = "Active";
            $comment->save();

            $activity = new activity;
            $activity->user_id = $user_id;
            $activity->description = "Replied a comment on a post($post_title[0])";
            $activity->save();
        }

        return response()->json([
                    'message' => 'success',
                    'data' => $data
        ]);
    }

    // for getting all the replies of a particular comment
    function getAllReplies(Request $request) {
        $data = $request->validate([
            'comment_id' => ['required', 'string', 'min:1', 'max:10000',],
            'post_id' => ['required']
                ]
        );
        $comment_table = db::table('comments')
                ->leftJoin('users', 'comments.user_id', '=', 'users.id')
                ->where('comments.parent_id', $data['comment_id'])
                ->select('users.first_name', 'users.last_name', 'users.picture', 'comments.id',
                        'comments.user_id', 'comments.parent_id as comment_id', 'comments.comment_name', 'comments.comment_body as reply_msg',
                        'comments.created_at')
                ->get();
        
        $likes_table = db::table('likes')
                ->where('like_type', '=', 'Comment')
                ->where('post_id', $data['post_id'])
                ->get();
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = 0;
        }

        $likes_comment_id = $likes_table->pluck('comment_id');
        $loggedIn_user_likes = $likes_table->where('user_id', $user_id)->pluck('comment_id');
        return response()->json([
                    'message' => 'success',
                    'data' => $comment_table,
                    'count_comment_likes' => $likes_comment_id,
                    'loggedIn_user_likes' => $loggedIn_user_likes
        ]);
    }

    // for counting the number of likes on a particular post
    function getLike(Request $request, $id) {
        if (Auth::check()) {
            $user_id = Auth::user()->id;

            $result = db::table('likes')
                    ->where('post_id', $id)
                    ->where('like_type', 'Post')
                    ->count();

            $user_like = db::table('likes')
                    ->where('post_id', $id)
                    ->where('user_id', $user_id)
                    ->where('like_type', 'Post')
                    ->count();

            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "data" => $result,
                        "auth_check" => $user_like,
            ]);
        } else {
            $result = db::table('likes')
                    ->where('post_id', $id)
                    ->where('like_type', 'Post')
                    ->count();

            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "data" => $result,
            ]);
        }
    }

    // code for liking and unliking a comments or replies
    function likeUnlikeComment(Request $request) {
        $data = $request->validate([
            'comment_id' => ['required', 'string', 'min:1', 'max:10000',],
            'id' => ['required', 'min:1']
                ]
        );
        $user_id = Auth::user()->id;

        $result = db::table('likes')
                ->where('comment_id', $data['comment_id'])
                ->where('user_id', $user_id)
                ->where('like_type', 'Comment')
                ->count();
        
        $post_title = db::table('posts')
                ->where('id', $data['id'])
                ->select('post_title')
                ->pluck('post_title');

        if ($result > 0) {
            db::table('likes')
                    ->where('comment_id', $data['comment_id'])
                    ->where('user_id', $user_id)
                    ->where('like_type', 'Comment')
                    ->delete();

            $new_count = db::table('likes')
                    ->where('comment_id', $data['comment_id'])
                    ->where('like_type', 'Comment')
                    ->count();

            $activity = new activity;
            $activity->user_id = $user_id;
            $activity->description = "Unliked a comment on a post ( $post_title )";
            $activity->save();

            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "data" => $new_count,
                        "post_title" => $post_title
            ]);
        } else {
            $new_like = new Likes;
            $new_like->post_id = $data['id'];
            $new_like->user_id = $user_id;
            $new_like->comment_id = $data['comment_id'];
            $new_like->like_type = 'Comment';
            $new_like->save();

            $activity = new activity;
            $activity->user_id = $user_id;
            $activity->description = "Liked a comment on post ( $post_title )";
            $activity->save();

            $new_count = db::table('likes')
                    ->where('comment_id', $data['comment_id'])
                    ->where('like_type', 'Comment')
                    ->count();

            $user_like = db::table('likes')
                ->where('comment_id', $data['comment_id'])
                ->where('user_id', $user_id)
                ->where('like_type', 'Comment')
                    ->count();

            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "data" => $new_count,
                        "auth_check" => $user_like,
            ]);
        }
    }

    // code for liking and unliking a post
    function likePost(Request $request, $id) {
        $user_id = Auth::user()->id;
        $result = db::table('likes')
                ->where('post_id', $id)
                ->where('user_id', $user_id)
                ->where('like_type', 'Post')
                ->count();

        $post_title = db::table('posts')
                ->where('id', $id)
                ->select('post_title')
                ->pluck('post_title');

        if ($result > 0) {
            db::table('likes')
                    ->where('post_id', $id)
                    ->where('user_id', $user_id)
                    ->where('like_type', 'Post')
                    ->delete();

            $new_count = db::table('likes')
                    ->where('post_id', $id)
                    ->where('like_type', 'Post')
                    ->count();

            $activity = new activity;
            $activity->user_id = $user_id;
            $activity->description = "Unliked a post ($post_title[0])";
            $activity->save();

            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "data" => $new_count,
            ]);
        } else {
            $activity = new activity;
            $activity->user_id = $user_id;
            $activity->description = "Liked a post ($post_title[0])";
            $activity->save();

            $new_like = new Likes;
            $new_like->post_id = $id;
            $new_like->user_id = $user_id;
            $new_like->like_type = 'Post';
            $new_like->save();

            $new_count = db::table('likes')
                    ->where('post_id', $id)
                    ->where('like_type', 'Post')
                    ->count();

            $user_like = db::table('likes')
                    ->where('post_id', $id)
                    ->where('user_id', $user_id)
                    ->where('like_type', 'Post')
                    ->count();

            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "data" => $new_count,
                        "auth_check" => $user_like,
            ]);
        }
    }

    // for counting the comments of a particular post
    function countComment(Request $request, $id) {
        $data = db::table('comments')
                ->where('post_id', $id)
                ->count();

        return response()->json([
                    "message" => "successful",
                    "code" => 200,
                    "data" => $data,
        ]);
    }

    // to get the saved post on a particular post
    function getSavedPost(Request $request, $id) {
        $user_id = Auth::user()->id;
        $result = db::table('favorites')
                ->where('post_id', $id)
                ->where('user_id', $user_id)
                ->count();

        if ($result > 0) {
            return response()->json([
                        'message' => "Data Found",
                        "code" => 200,
                        "data" => $result,
            ]);
        } else {
            return response()->json([
                        'message' => "No data found",
                        "code" => 200,
                        "data" => 0
            ]);
        }
    }

    // for adding a post to user's favorite
    public function savedPost(Request $request, $id) {
        $user_id = Auth::user()->id;
        $result = db::table('favorites')
                ->where('post_id', $id)
                ->where('user_id', $user_id)
                ->count();

        $post_title = db::table('posts')
                ->where('id', $id)
                ->select('post_title')
                ->pluck('post_title');

        if ($result > 0) {
            db::table('favorites')
                    ->where('post_id', $id)
                    ->where('user_id', $user_id)
                    ->delete();

            $new_count = db::table('favorites')
                    ->where('post_id', $id)
                    ->where('user_id', $user_id)
                    ->count();

            $count_user_total_saved = db::table('favorites')
                    ->where('user_id', $user_id)
                    ->count();

            $activity = new activity;
            $activity->user_id = $user_id;
            $activity->description = "Unsaved a post ($post_title[0])";
            $activity->save();

            return response()->json([
                        'message' => "favorite count",
                        "code" => 200,
                        "data" => $new_count,
                        "count_user_total_saved" => $count_user_total_saved
            ]);
        } else {
            $user_id = Auth::user()->id;

            $new_favorite = new Favorite;
            $new_favorite->post_id = $id;
            $new_favorite->user_id = $user_id;
            $new_favorite->save();

            $new_count = db::table('favorites')
                    ->where('post_id', $id)
                    ->where('user_id', $user_id)
                    ->count();

            $count_user_total_saved = $new_count = db::table('favorites')
                    ->where('user_id', $user_id)
                    ->count();

            $activity = new activity;
            $activity->user_id = $user_id;
            $activity->description = "Added a post ($post_title[0]) to favorite ";
            $activity->save();

            return response()->json([
                        'message' => "favorite count",
                        "code" => 200,
                        "data" => $new_count,
                        "count_user_total_saved" => $count_user_total_saved
            ]);
        }
    }

    // for the user's details on the user profile page
    public function user_profile(Request $request) {
        $user_id = Auth::user()->id;

        $count_likes = db::table('likes')
                ->where('user_id', $user_id)
                ->count();

        $saved_post = db::table('favorites')
                ->where('user_id', $user_id)
                ->count();

        $user_picture = db::table('users')
                ->where('id', $user_id)
                ->get('picture');

        $comment_counts = db::table('comments')
                ->where('user_id', $user_id)
                ->count();

        $profile_details = [
            'user_picture' => $user_picture[0]->picture,
            'likes' => $count_likes,
            'saved_post' => $saved_post,
            'comments' => $comment_counts
        ];

        if (request()->ajax()) {
            if ($request->start_date != '' && $request->end_date != '') {
                $data = DB::table('activities')
                        ->whereDate('created_at', '>=', $request->start_date)
                        ->whereDate('created_at', '<=', $request->end_date)
                        ->where('user_id', $user_id)
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
                                return date('F j, Y, g:ia', strtotime($data->created_at));
                            })
                            ->make(true);
        }
        return view('user_profile', ['profile_details' => $profile_details]);
    }

    // for upload / replace user profile picture
    public function userPhoto(Request $request) {
        $data = $request->validate(
                [
                    'picture' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:6000'],
                ],
                [
                    'picture.max' => 'The image is bigger than 6mb',
                    'picture.mimes' => 'The image has to be png,jpg or jpeg',
                    'picture.images' => 'Only images can be uploaded',
                ]
        );

        $delete_image_name = Auth::user()->picture;
        $delete_image_path = public_path('images/' . $delete_image_name);
        if (File::exists($delete_image_path)) {
            if ($delete_image_name == 'rabbit.jpg') {
                $do_nothing = 'do nothing';
            } else {
                File::delete($delete_image_path);
            }
        }

        $ran = substr(str_shuffle("123456789abcdefghijklmnopqrstuvwxyz"), 0, 4);
        $image = $ran . time() . '.' . $data['picture']->extension();
        $user_id = Auth::user()->id;
        $data['picture']->move(public_path('images'), $image);

        user::select()
                ->where('id', '=', $user_id)
                ->update(['picture' => $image]);

        $user_email = Auth::user()->email;
        $first_name = Auth::user()->first_name;
        $email_data = [
            'subject' => 'Activity notification',
            'name' => $first_name,
            'user_email' => $user_email,
            'topic1' => 'profile picture'
        ];

        Mail::to($user_email)->send(new \App\Mail\userChanges($email_data));

        $activity = new activity;
        $activity->user_id = $user_id;
        $activity->description = "Replaced profile picture";
        $activity->save();

        return response()->json([
                    'message' => "Data Found",
                    "code" => 200,
                    "data" => $image,
        ]);
    }

    // code for changing user password
    public function change_password(Request $request) {
        $data = $request->validate([
            'password' => ['required', 'string', 'min:3', 'confirmed'],
                ]
        );
        $id = Auth::user()->id;
        User::select()
                ->where('id', '=', $id)
                ->update(['password' => Hash::make($data['password'])]);

        $user_email = Auth::user()->email;
        $first_name = Auth::user()->first_name;
        $email_data = [
            'subject' => 'Security alert',
            'name' => $first_name,
            'user_email' => $user_email,
            'topic1' => 'password'
        ];

        Mail::to($user_email)->send(new \App\Mail\userChanges($email_data));

//          $user = User::where('id', $id)->first();
//            $enrollmentData = [
//                'body' => 'Your password have been change successfully',
//                'enrollmentText' => 'you are allowed to enroll',
//                    'url' => url('/'),
//                'thankyou' => 'you have 14 days to enroll'
//            ];
//            
//             $user->notify(new UserChanges($enrollmentData));

        $user_id = Auth::user()->id;

        $activity = new activity;
        $activity->user_id = $user_id;
        $activity->description = "Changed password";
        $activity->save();

        return response()->json([
                    'message' => "Data Found",
                    "code" => 200,
        ]);
    }

    // to get all the subscription for the user
    function getAllSubscription(Request $request) {
        $user_id = Auth::user()->id;
        $get_all_sub = db::table('newsletter_subscriptions')
                ->where('user_id', $user_id)
                ->get();

        $news = $get_all_sub->where('subscription_name', 'News')
                ->where('user_id', $user_id)
                ->count();

        $business = $get_all_sub->where('subscription_name', 'Business')
                ->where('user_id', $user_id)
                ->count();

        $entertainment = $get_all_sub->where('subscription_name', 'Entertainment')
                ->where('user_id', $user_id)
                ->count();

        $sport = $get_all_sub->where('subscription_name', 'Sport')
                ->where('user_id', $user_id)
                ->count();

        $technology = $get_all_sub->where('subscription_name', 'Technology')
                ->where('user_id', $user_id)
                ->count();

        $count_all_sub = [
            "news" => $news,
            "business" => $business,
            "entertainment" => $entertainment,
            "sport" => $sport,
            "technology" => $technology
        ];

        return response()->json([
                    'message' => 'success on sub',
                    'data' => $get_all_sub,
                    "get_sub" => $count_all_sub
        ]);
    }

    // to subscribe or unsubscribe from a newsletter
    function subcribeUnsubcribe(Request $request) {
        $data = $request->validate([
            'subscription_name' => ['required', 'string', 'min:1', 'max:10000',],
            'subscription_picture' => ['max:10000',],
            'unsubscribe' => ['min:0', 'max:11',],
                ]
        );
        $user_id = Auth::user()->id;
        if ($data['unsubscribe'] == 'unsubscribe') {
            db::table('newsletter_subscriptions')
                    ->where('subscription_name', $data['subscription_name'])
                    ->where('user_id', $user_id)
                    ->delete();

            $activity = new activity;
            $activity->user_id = $user_id;
            $activity->description = "Unsubscribed from ( $request->subscription_name ) newsletter";
            $activity->save();

            $new_count = 0;
        } else {
            $count_subscription = db::table('newsletter_subscriptions')
                    ->where('subscription_name', $data['subscription_name'])
                    ->where('user_id', $user_id)
                    ->count();

            if ($count_subscription > 0) {
                db::table('newsletter_subscriptions')
                        ->where('subscription_name', $data['subscription_name'])
                        ->where('user_id', $user_id)
                        ->delete();
                $new_count = 0;

                $activity = new activity;
                $activity->user_id = $user_id;
                $activity->description = "Unsubscribed from ( $request->subscription_name ) newsletter";
                $activity->save();
            } else {
                $newsSub = new newsletterSubscription;
                $newsSub->user_id = $user_id;
                $newsSub->subscription_name = $data['subscription_name'];
                $newsSub->subscription_picture = $data['subscription_picture'];
                $newsSub->save();

                $activity = new activity;
                $activity->user_id = $user_id;
                $activity->description = "Subscribed to ( $request->subscription_name ) newsletter";
                $activity->save();

                $new_count = 1;
            }
        }
        return response()->json([
                    'message' => 'success',
                    'data' => $new_count,
                    'ubong' => 'testing'
        ]);
    }

}
