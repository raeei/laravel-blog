<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider and all of them will
  | be assigned to the "web" middleware group. Make something great!
  |
 */
  Auth::routes(['verify' => true]);
Route::get('email', function () {
    return view('email.user_changes');
});

Route::fallback(function(){
    return view('errors.404');
});

Route::get('login_email', function () {
    return view('email.login_email');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('welcome');
Route::get('{post_name} {id}', [App\Http\Controllers\HomeController::class, 'postPage']);
Route::get('likes/{id}', [App\Http\Controllers\HomeController::class, 'getLike']);
Route::get('countComment/{id}', [App\Http\Controllers\HomeController::class, 'countComment']);
Route::get('getAllComment/{id}', [App\Http\Controllers\HomeController::class, 'getAllComment'])->name('getAllComment');
Route::Post('getAllReplies', [App\Http\Controllers\HomeController::class, 'getAllReplies'])->name('getAllReplies');
Route::get('search_post', [App\Http\Controllers\HomeController::class, 'search_post']);
Route::get('network', [App\Http\Controllers\HomeController::class, 'network'])->name('network');



Route::group(['middleware' => 'prevent-back-history'],function(){

Auth::routes();
Route::group(['middleware' => ['auth',]], function () {
    Route::get('getAllSubscription', [App\Http\Controllers\HomeController::class, 'getAllSubscription'])->name('subscription');
    Route::Post('subcribeUnsubcribe', [App\Http\Controllers\HomeController::class, 'subcribeUnsubcribe'])->name('subcribeUnsubcribe');
    Route::get('favorite-post', [App\Http\Controllers\HomeController::class, 'favoritePost']);
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'user_profile'])->name('profile');
    Route::get('likePost/{id}', [App\Http\Controllers\HomeController::class, 'likePost']);
    Route::get('getSavedPost/{id}', [App\Http\Controllers\HomeController::class, 'getSavedPost']);   
    Route::Post('createComment', [App\Http\Controllers\HomeController::class, 'createComment'])->name('createComment');
    Route::Post('replyComment', [App\Http\Controllers\HomeController::class, 'replyComment'])->name('replyComment');
    Route::get('savePost/{id}', [App\Http\Controllers\HomeController::class, 'savedPost']);
    Route::Post('/likeUnlikeComment', [App\Http\Controllers\HomeController::class, 'likeUnlikeComment'])->name('likeUnlikeComment');
    Route::Post('/userPhoto', [App\Http\Controllers\HomeController::class, 'userPhoto'])->name('user.uploadPhoto');
    Route::post('/userChangePassword', [App\Http\Controllers\HomeController::class, 'change_password'])->name('user.changePassword');
});
});

Route::prefix('editor')->middleware(['auth', 'isEditor'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\EditorController::class, 'dashboard'])->name('editor.dashboard');
    Route::get('editorActivity', [App\Http\Controllers\EditorController::class, 'editorActivity'])->name('editorActivity');
    Route::post('storePost', [App\Http\Controllers\EditorController::class, 'storePost'])->name('editor.storePost');
    Route::post('editPost', [App\Http\Controllers\EditorController::class, 'editPost'])->name('editor.editPost');
    Route::post('viewPost', [App\Http\Controllers\EditorController::class, 'viewPost'])->name('editor.viewPost');
    Route::Post('getPostById', [App\Http\Controllers\EditorController::class, 'getPostId'])->name('editor.getPostById');
    Route::Post('editorChangePassword', [App\Http\Controllers\EditorController::class, 'change_password'])->name('editor.changePassword');
});

Route::prefix('moderator')->middleware(['auth', 'isModerator'])->group(function () {
    Route::get('all_advert', [App\Http\Controllers\AdminController::class, 'all_advert'])->name('admin.all_advert');
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'home'])->name('admin.dashboard');
    //Route::get('/us', [App\Http\Controllers\AdminController::class, 'us'])->name('admin.us');
    Route::get('posts', [App\Http\Controllers\AdminController::class, 'all_posts'])->name('admin.all_posts');
    Route::post('viewPost', [App\Http\Controllers\AdminController::class, 'viewPost'])->name('admin.viewPost');
    Route::post('postAction', [App\Http\Controllers\AdminController::class, 'postAction'])->name('admin.postAction');
    Route::get('users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users'); 
    Route::Post('viewUserDetails', [App\Http\Controllers\AdminController::class, 'viewUserDetails'])->name('admin.viewUserDetails');   
    Route::Post('editGetUserId', [App\Http\Controllers\AdminController::class, 'editGetUserId'])->name('admin.editGetUserId');   
    Route::post('/update', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');
    Route::get('all_comments', [App\Http\Controllers\AdminController::class, 'all_comments'])->name('admin.all_comments');
    Route::get('viewComment', [App\Http\Controllers\AdminController::class, 'viewComment'])->name('admin.viewComment');
    Route::Post('getReply', [App\Http\Controllers\AdminController::class, 'getReply'])->name('admin.getReply');
    Route::get('all_likes', [App\Http\Controllers\AdminController::class, 'all_likes'])->name('admin.all_likes');
    Route::post('getLikeDetails', [App\Http\Controllers\AdminController::class, 'getLikeDetails'])->name('editor.getLikeDetails');
    Route::get('all_admin', [App\Http\Controllers\AdminController::class, 'all_admin'])->name('admin.all_admin');
    Route::post('admin_details', [App\Http\Controllers\AdminController::class, 'admin_details'])->name('admin.admin_details');
    Route::Post('add_admin', [App\Http\Controllers\AdminController::class, 'add_admin'])->name('admin.add_admin');
    Route::get('users_details', [App\Http\Controllers\AdminController::class, 'user_details'])->name('admin.users_details');
    Route::Post('adminChangePassword', [App\Http\Controllers\AdminController::class, 'change_password'])->name('admin.changePassword');
    Route::get('userActivity/{id}', [App\Http\Controllers\AdminController::class, 'userActivity'])->name('userActivity');
    Route::get('userComment/{id}', [App\Http\Controllers\AdminController::class, 'userComment'])->name('userComment');
    Route::get('userFavorite/{id}', [App\Http\Controllers\AdminController::class, 'userFavorite'])->name('userFavorite');
    Route::get('userLikes/{id}', [App\Http\Controllers\AdminController::class, 'userLikes'])->name('userLikes');
});
