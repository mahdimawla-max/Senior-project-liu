<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\HasApiTokens;
use \App\Http\Controllers\PageController;

Route::get('/',[PageController::class , 'getLoginPage']);
Route::get('/register', [PageController::class , 'getSignInPage']);
Route::get('/post', [PageController::class , 'getPostPage'])->name('post');
Route::get('/profile', [PageController::class , 'getProfilePage']);
Route::get('/profileedit', [PageController::class , 'getEditProfile']);
Route::get('/home/{catId?}', [PageController::class, 'showSearchPage']);
Route::get('/search', [PostController::class, 'search'])->name('search');
Route::get('/comment/{postId}' , [PageController::class , 'getCommentsPage']);

Route::post('/delete-post/{id}', [PostController::class, 'delete']);
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::middleware('auth:web')->post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/create-user', [UserController::class, 'create']);
Route::post('/update-user/{id}', [UserController::class, 'update']);
Route::post('/create-share/{userId}', [ShareController::class, 'create']);
Route::post('/posts/{post}/react', [PostController::class, 'react']);
Route::post('/create-comment', [CommentController::class, 'create']);
Route::post('/upload-photo', [PostController::class, 'uploadPhoto'])->name('upload.photo');

Route::get('/users', [UserController::class, 'getAllUsers']);
Route::delete('/delete-user/{id}', [UserController::class, 'delete']);
Route::get('/show-user/{id}', [UserController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'getAllCategories']);
Route::post('/create-categories', [CategoryController::class, 'create']);
Route::post('/update-categories/{id}', [CategoryController::class, 'update']);
Route::delete('/delete-categories/{id}', [CategoryController::class, 'delete']);
Route::get('/show-categories/{id}', [CategoryController::class, 'show']);
Route::get('/posts', [PostController::class, 'getAllPosts']);
Route::post('/create-post', [PostController::class, 'create']);
Route::post('/update-post/{id}', [PostController::class, 'update']);
Route::get('/show-post/{id}', [PostController::class, 'show']);
Route::get('/comments', [CommentController::class, 'getAllComments']);
Route::post('/update-commment/{id}', [CommentController::class, 'update']);
Route::delete('/delete-comment/{id}', [CommentController::class, 'delete']);
Route::get('/show-comment/{id}', [CommentController::class, 'show']);
Route::get('/reactions', [ReactionController::class, 'getAllReactions']);
Route::post('/create-rection', [ReactionController::class, 'create']);
Route::post('/update-reaction/{id}', [ReactionController::class, 'update']);
Route::delete('/delete-reaction/{id}', [ReactionController::class, 'delete']);
Route::get('/show-reaction/{id}', [ReactionController::class, 'show']);
Route::get('/shares', [ShareController::class, 'getAllShares']);
Route::post('/update-share/{id}', [ShareController::class, 'update']);
Route::delete('/delete-share/{id}', [ShareController::class, 'delete']);
Route::get('/show-share/{id}', [ShareController::class, 'share']);
Route::post('/users/{userId}/shares/{shareId}', [ShareController::class, 'attachShareToUser']);
Route::get('/users/{userId}/shares', [ShareController::class, 'getUserShares']);
























