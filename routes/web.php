<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

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

Route::get('/', '\App\Http\Controllers\PostController@index')->name('home');

Route::get('/posts/unapproved', '\App\Http\Controllers\PostController@showUnapproved')->name('posts.showUnapproved');

Route::put('/posts/unapproved/{id}', '\App\Http\Controllers\PostController@approve')->name('posts.approve');

Route::resource('posts', PostController::class);

Route::resource('comments', CommentController::class);

require __DIR__.'/auth.php';
