<?php

Auth::routes();

Route::get('/', 'PostController@index');
Route::get('/one', 'PostController@one');
Route::get('/upload', 'PostController@new');
Route::post('/upload', 'PostController@upload');