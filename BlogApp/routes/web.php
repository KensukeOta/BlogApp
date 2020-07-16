<?php

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

Route::get('/', 'PostController@index');

Route::get('/posts/new', 'PostController@new');
Route::post('/posts/new', 'PostController@create');

Route::get('/posts/{post}', 'PostController@show')->where('post', '[0-9]+');

Route::get('/posts/{post}/edit', 'PostController@edit')->middleware('auth');
Route::patch('/posts/{post}', 'PostController@update');

Route::delete('/posts/{post}', 'PostController@destroy');

Route::post('/posts/{post}', 'CommentController@create');

Auth::routes();

Route::get('/logout', 'UserController@logout');

Route::get('/home', 'HomeController@index')->name('home');

//画像をアップロードするページ
Route::get('/upload', 'ImageController@input');
//画像を保存したり画像名をDBに格納する部分
Route::post('/upload', 'ImageController@upload');
//保存した画像を表示するページ
Route::get('/output', 'ImageController@output');
