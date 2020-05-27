<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/', 'DashboardController@index')->name('dashboard');

Route::resource('categories', 'CategoryController', [
    'names' => [
        'index' => 'categories'
    ]
])->except('show');

Route::resource('tags', 'TagController', [
    'names' => [
        'index' => 'tags'
    ]
])->except('show');

Route::resource('posts', 'PostController', [
    'names' => [
        'index' => 'posts'
    ]
])->except('show');
Route::put('posts/{post}/publish', 'PostController@publish')->name('posts.publish');

Route::resource('users', 'UserController', [
    'names' => [
        'index' => 'users'
    ]
])->only(['index', 'destroy']);
Route::put('users/{user}/permission', 'UserController@permission')->name('users.permission');
