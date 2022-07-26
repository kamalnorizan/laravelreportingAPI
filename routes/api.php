<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Post;
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

Route::get('/posts', function(){
    $posts=Post::latest()->get(); //Eloquent
    //select * from posts order by created_at

    return response()->json($posts);
});

Route::get('posts/{id}', function ($id) {
    $post = Post::find($id);
    //select * from posts where id=?
    //Untuk select 1 post

    return response()->json($post);
});
