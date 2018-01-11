<?php

Auth::routes();

Route::get('/', 'PostController@index');
Route::get('/post/{post}', 'PostController@show');
Route::get('/upload', 'PostController@new');
Route::post('/upload', 'PostController@upload');
Route::get('/search', 'PostController@search');
Route::post('/bookmark', 'BookmarkController@store');
Route::delete('/bookmark/{bookmark}', 'BookmarkController@delete');
