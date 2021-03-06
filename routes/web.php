<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\LikeController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\TwilioSMSController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\VideoController;
use App\Http\Controllers\User\AlbumController;
use App\Http\Controllers\User\FriendController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\GoogleController;
use Illuminate\Support\Facades\Session;



Route::get('/set-locale/{locale}', function ($locale) {

    Session::put('locale', $locale);
    return redirect()->back();
    //dd(Session::get('locale'));
})->name('setlocal');

Route::middleware(['locale'])->group(function () {

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


        Route::middleware(['disable_back_btn'])->group(function () {
            Route::middleware(['auth:user'])->group(function () {

                Route::get('/home',                       [UserController::class, 'home'])->name('home');
                Route::get('/profile',                    [UserController::class, 'profile'])->name('profile');
                Route::get('/profile/edit',               [UserController::class, 'profileEdit'])->name('profileedit');

                Route::get('/profile/change-password',    [UserController::class, 'chnagePassword'])->name('changepassword');
                Route::post('profile/change/password',    [UserController::class, 'newPassword'])->name('newpassword');

                Route::post('/profile/edit',              [UserController::class, 'ProfileEditAction'])->name('profileeditaction');
                Route::get('/post/add',                   [PostController::class, 'index'])->name('post');

                Route::post('/posts/upload',               [PostController::class, 'upload'])->name('uploadpost');
                Route::get('/upload-post/edit/{id}',      [PostController::class, 'editPost'])->name('editpost');
                Route::post('/upload-post/edit/{id}',     [PostController::class, 'editPostAction'])->name('editpostaction');
                Route::get('posts/delete/{id}',            [PostController::class, 'deletePost'])->name('deletepost');

                Route::get('/album',                        [AlbumController::class, 'index'])->name('album');
                Route::get('/album/details/{id}',                 [AlbumController::class, 'show'])->name('albumdetails');
                Route::get('/add/album',                     [AlbumController::class, 'create'])->name('cretealbum');
                Route::post('/album/add',                   [AlbumController::class, 'upload'])->name('upload');

                Route::get('/likes/{id}',              [LikeController::class, 'likePost'])->name('likepost');


                Route::get('/comments/{id}',            [CommentController::class, 'index'])->name('comments');
                Route::post('/comments/upload/{id}',    [CommentController::class, 'comment'])->name('commentUpload');



                Route::get('/chat',                 [ChatController::class, 'index'])->name('chats');
                Route::post('/send-message',        [ChatController::class, 'sendMessage'])->name('sendmessage');

                Route::get('/videos',                 [VideoController::class, 'index'])->name('videos');
                Route::post('/send-videos',        [VideoController::class, 'upload'])->name('upload.videos');




                Route::get('/logout',                     [UserController::class, 'logout'])->name('logout');
            });
        });
    });
});
