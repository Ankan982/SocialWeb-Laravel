<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\LikeController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\TwilioSMSController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\AlbumController;
use App\Http\Controllers\User\FriendController;
use App\Http\Controllers\User\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',        [UserController::class, 'index'])->name('index');
Route::get('/send', [TwilioSMSController::class, 'send']);

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {

    Route::middleware(['userauth'])->group(function () {

        Route::get('/sigin',                     [UserController::class, 'signin'])->name('signin');
        Route::get('/signup',                    [UserController::class, 'signup'])->name('signup');
        Route::post('/signup',                   [UserController::class, 'registerAction'])->name('signupaction');
        Route::get('/verify-email/{token}',      [UserController::class, 'emailVerification'])->name('email.verification');
        Route::post('/login',                    [UserController::class, 'loginAction'])->name('loginaction');

        Route::get('auth/google',               [GoogleController::class, 'redirectToGoogle'])->name('googlepage');
        Route::get('auth/google/callback',      [GoogleController::class, 'handleGoogleCallback']);
    });

    Route::middleware(['auth:user'])->group(function () {

        Route::get('/home',                       [UserController::class, 'home'])->name('home');
        Route::get('/profile',                    [UserController::class, 'profile'])->name('profile');
        Route::get('/profile/edit',               [UserController::class, 'profileEdit'])->name('profileedit');

        Route::get('/profile/change-password',    [UserController::class, 'chnagePassword'])->name('changepassword');
        Route::post('profile/change/password',    [UserController::class, 'newPassword'])->name('newpassword');

        Route::post('/profile/edit',              [UserController::class, 'ProfileEditAction'])->name('profileeditaction');
        Route::get('/post/add',                   [PostController::class, 'index'])->name('post');

        Route::post('/post/upload',               [PostController::class, 'upload'])->name('uploadpost');
        Route::get('/upload-post/edit/{id}',      [PostController::class, 'editPost'])->name('editpost');
        Route::post('/upload-post/edit/{id}',     [PostController::class, 'editPostAction'])->name('editpostaction');
        Route::get('post/delete/{id}',            [PostController::class, 'deletePost'])->name('deletepost');

        Route::get('/album',                        [AlbumController::class, 'index'])->name('album');
        Route::get('/album/details/{id}',                 [AlbumController::class, 'show'])->name('albumdetails');
        Route::get('/add/album',                     [AlbumController::class, 'create'])->name('cretealbum');
        Route::post('/album/add',                   [AlbumController::class, 'upload'])->name('upload');

        Route::get('/likes/{id}',              [LikeController::class, 'likePost'])->name('likepost');


        Route::get('/comments/{id}',            [CommentController::class, 'index'])->name('comments');
        Route::post('/comments/upload/{id}',    [CommentController::class, 'comment'])->name('commentUpload');

        Route::get('/friends',                   [FriendController::class, 'index'])->name('friends');




        Route::get('/logout',                     [UserController::class, 'logout'])->name('logout');
    });
});
