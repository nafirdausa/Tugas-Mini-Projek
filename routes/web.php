<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProjekController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\NotificationController;

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

Route::get('/home', [ProjekController::class, 'index'])->name('home');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/handle-register', [UserController::class, 'handleRegister'])->name('handle_register');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/handle-login', [UserController::class, 'handleLogin'])->name('handleLogin');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/MyProfile', [UserController::class, 'profile'])->name('profile');

Route::get('/formPost', [PostController::class, 'posting'])->name('posting');
Route::post('/post-request', [PostController::class, 'postRequest'])->name('postRequest');
Route::get('/seePost', [PostController::class, 'detailPosting'])->name('detail_posting');

Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');

Route::get('/', [BookmarkController::class, 'seeBookmark'])->name('bookmark');
Route::post('/posts/{post}/bookmark', [BookmarkController::class, 'bookmark'])->name('posts.bookmark');
Route::delete('/posts/{post}/bookmark', [BookmarkController::class, 'unbookmark'])->name('posts.bookmark');

// Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('users.follow');
// Route::delete('/users/{user}/follow', [FollowController::class, 'unfollow'])->name('users.follow');

Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('users.follow');
Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('users.unfollow');

Route::get('/notifications', [NotificationController::class, 'notif'])->name('notifications');
Route::post('/notifications/{notification}/markAsRead', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/notifications', [NotificationController::class, 'notif'])->name('notifications');
//     Route::post('/notifications/{notification}/markAsRead', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
// });