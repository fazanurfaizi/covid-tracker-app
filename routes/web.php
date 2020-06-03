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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/posts/{id}/likes', 'PostController@like');
    Route::get('/profile', 'ProfileController@edit')->name('profile');
    Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
    Route::put('/profile/password', 'ProfileController@password')->name('profile.password');
    Route::post('/posts/{post}/comment', 'CommentController@store')->name('posts.comment');
});

Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/posts/{slug}', 'PostController@show')->name('posts.show');
Route::get('/tags/{slug}/posts', 'TagController@index')->name('tag.posts');
