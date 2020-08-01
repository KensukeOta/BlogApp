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

Route::get('/search', 'PostController@search');
Route::post('/search', 'PostController@result');

Route::prefix('posts')->name('posts.')->group(function () {
    Route::put('/{post}/like', 'PostController@like')->name('like')->middleware('auth');
    Route::delete('/{post}/like', 'PostController@unlike')->name('unlike')->middleware('auth');
});


Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{user:name}', 'UserController@home')->name('home');
    Route::get('/{user:name}/posts', 'UserController@index');
    Route::get('/{user:name}/likes', 'UserController@likes')->name('likes');
    Route::get('/{user:name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{user:name}/followers', 'UserController@followers')->name('followers');
    Route::middleware('auth')->group(function () {
        Route::put('/{user:name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{user:name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});

Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

Auth::routes();

Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
});

Route::get('/logout', 'UserController@logout');

Route::post('/home', 'UserController@store')->middleware('auth');

// Route::get('/home', 'HomeController@index')->name('home');
