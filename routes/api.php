<?php

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

Route::group(['namespace' => 'Api'], function () {

    Route::post('posts/{post}/likes', 'PostLikeController@store')->name('posts.likes.store');
    Route::delete('posts/{post}/dislike', 'PostLikeController@destroy')->name('posts.likes.destroy');

    Route::post('comments/{comment}/likes', 'CommentLikeController@store')->name('comments.likes.store');
    Route::delete('comments/{comment}/dislike', 'CommentLikeController@destroy')->name('comments.likes.destroy');

});
