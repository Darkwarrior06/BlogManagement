<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WriterController;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/admin', function (Request $request) {
    return $request->user();
});

Route::get('login/comments', [CommentController::class,'index']);
Route::delete('login/delete/{id}', [WriterController::class,'delete']);

Route::get('writer/index', [WriterController::class,'index']);
Route::get('writer/show/{id}', [WriterController::class,'show']);
Route::get('writer/show_posts/{id}', [WriterController::class,'show_posts']);
Route::post('writer/add', [WriterController::class,'add']);
Route::put('writer/edit/{id}', [WriterController::class,'edit']);
Route::delete('writer/delete/{id}', [WriterController::class,'delete']);

Route::get('post/index', [PostController::class, 'index']);
Route::get('post/show/{id}', [PostController::class, 'show']);
Route::post('post/add/{id}/{category_id}', [PostController::class, 'add']);
Route::put('post/edit/{id}', [PostController::class, 'edit']);
Route::delete('post/delete/{id}', [PostController::class, 'delete']);

Route::get('comment/index', [CommentController::class, 'index']);
Route::get('comment/show/{id}', [CommentController::class, 'show']);
Route::get('comment/show_comments_on_post/{id}', [CommentController::class, 'show_comments']);
Route::post('comment/add/{writer_id}/{post_id}', [CommentController::class, 'add']);
Route::put('comment/edit/{id}', [CommentController::class, 'edit']);
Route::delete('comment/delete/{id}', [CommentController::class, 'delete']);