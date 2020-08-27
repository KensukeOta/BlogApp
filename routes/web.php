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

Route::name('posts.')->group(function () {
    Route::get('/', 'PostController@index')->name('index');
    Route::prefix('posts')->group(function () {
        Route::get('/new', 'PostController@new')->middleware('auth')->name('new');
        Route::post('/new', 'PostController@create')->name('create');
        Route::get('/search', 'PostController@search')->name('search');
        Route::post('/search', 'PostController@result')->name('result');
        Route::get('/{post}', 'PostController@show')->where('post', '[0-9]+')->name('show');
        Route::get('/{post}/edit', 'PostController@edit')->middleware('auth')->name('edit');
        Route::patch('/{post}', 'PostController@update')->middleware('auth')->name('update');
        Route::delete('/{post}', 'PostController@destroy')->name('destroy');
        Route::post('/{post}', 'CommentController@create')->name('comment');
        Route::put('/{post}/like', 'PostController@like')->name('like')->middleware('auth');
        Route::delete('/{post}/like', 'PostController@unlike')->name('unlike')->middleware('auth');
    });
});


Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{user:name}', 'UserController@home')->name('home');
    Route::get('/{user:name}/posts', 'UserController@index')->name('index');
    Route::get('/{user:name}/likes', 'UserController@likes')->name('likes');
    Route::get('/{user:name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{user:name}/followers', 'UserController@followers')->name('followers');
    Route::middleware('auth')->group(function () {
        Route::get('/{user:name}/setting', 'UserController@setting')->name('setting');
        Route::post('/{user:name}/setting', 'UserController@store');
        Route::put('/{user:name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{user:name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});

Route::get('/logout', 'UserController@logout')->name('logout');

Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

Auth::routes();

Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});

Route::prefix('register')->name('register.')->group(function () {
    Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
    Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});