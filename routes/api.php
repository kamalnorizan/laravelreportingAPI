<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Validator;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//posts
Route::get('/posts', 'PostController@index');
Route::get('posts/{post}', 'PostController@show');
Route::post('posts', 'PostController@store');
Route::post('posts/{post}', 'PostController@update');
Route::delete('posts/{post}', 'PostController@destroy');
Route::get('posts/byUser/{user_id}', 'PostController@postsByUser');

//comments
Route::get('/comments', 'CommentController@index');


