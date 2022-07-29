<?php

//posts
Route::get('/posts', 'PostController@index');
Route::get('/posts/byUser', 'PostController@postsByUser');
Route::get('/posts/{post}', 'PostController@show');
Route::post('/posts', 'PostController@store');
Route::post('/posts/{post}', 'PostController@update');
Route::delete('/posts/{post}', 'PostController@destroy');

//comments
Route::get('/comments', 'CommentController@index');
