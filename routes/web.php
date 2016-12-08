<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'api/v1'], function() {
    Route::resource('author', 'AuthorController', [
        'except'        => ['create', 'edit'],
        'parameters'    => ['author' => 'author_id'],
        'names'         => ['show' => 'profile'],
    ]);
    Route::get('book/{author_name?}', 'BookController@index');
    Route::resource('book', 'BookController', [
        'except'        => ['create', 'edit', 'index'],
        'parameters'    => ['book' => 'book_id'],
        'names'         => ['show' => 'profile'],
    ]);
});
