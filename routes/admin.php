<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::resource('categories', 'CategoryController', [
    'names' => [
        'index' => 'categories'
    ]
])->except('show');
