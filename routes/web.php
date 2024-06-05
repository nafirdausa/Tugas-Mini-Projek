<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProjekController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CommentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ProjekController::class, 'index'])->name('home');

// login-register
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/handle-register', [UserController::class, 'handleRegister'])->name('handle_register');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/handle-login', [UserController::class, 'handleLogin'])->name('handleLogin');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// profile
Route::get('/MyProfile', [UserController::class, 'profile'])->name('profile');
Route::get('/edit-profile/{user}', [UserController::class, 'editProfile'])->name('edit-profile');
Route::post('/edit-profile/{user}', [UserController::class, 'editProfileRequest'])->name('editProfileRequest');
Route::post('/check-password', [UserController::class, 'checkPassword'])->name('check-password');
// Route::post('/confirm-password', [UserController::class, 'confirmPassword'])->name('profile.confirmPassword');

// Postingan
Route::get('/formPost', [PostController::class, 'posting'])->name('posting');
Route::post('/post-request', [PostController::class, 'postRequest'])->name('postRequest');
Route::get('/seePost/{id}', [PostController::class, 'detailPosting'])->name('detail_posting');

// Like Postingan
Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');

// Bookmark
Route::get('/seeBookmark', [BookmarkController::class, 'seeBookmark'])->name('bookmark');
Route::post('/posts/{post}/bookmark', [BookmarkController::class, 'bookmark'])->name('posts.bookmark');
Route::delete('/posts/{post}/unbookmark', [BookmarkController::class, 'unbookmark'])->name('posts.unbookmark');


// Following & Followers
Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('users.follow');
Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('users.unfollow');

// Notification
Route::get('/notifications', [NotificationController::class, 'notif'])->name('notifications');
Route::get('/notifications/comments', [NotificationController::class, 'comments'])->name('notifications.comments');
Route::get('/notifications/likes', [NotificationController::class, 'likes'])->name('notifications.likes');
Route::post('/like/{postId}', [LikeController::class, 'likePost'])->name('like.post');
Route::post('/follow/{userId}', [FollowController::class, 'followUser'])->name('follow.user');

// Comments
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('/comments/{comment}/likes', [CommentController::class, 'likeComment'])->name('comments.likes');
Route::delete('/comments/{comment}/likes', [CommentController::class, 'unlikeComment'])->name('comments.likes');
