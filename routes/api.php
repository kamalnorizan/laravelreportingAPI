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

Route::get('/posts', 'PostController@index');

Route::get('posts/{post}', 'PostController@show');

Route::get('posts/byUser/{user_id}', function ($user_id) {
    $posts = Post::where('user_id',$user_id)->get();
    //select * from posts where user_id = ?

    return response()->json($posts);
});

Route::delete('posts/{id}', function ($id) {
    $post = Post::find($id);
    $post->delete();

    // Post::where('id',$id)->first()->delete();
    // Post::find($id)->delete();
    // Post::destroy($id);

    return response()->json(['status'=>'Deleted']);
});

Route::post('posts', function (Request $request) {
    // $post = new Post;
    // $post->title = $request->title;
    // $post->content = $request->content;
    // $post->user_id = $request->user_id;
    // $post->save();

    $user=User::find($request->user_id);
    if($user->posts->count()>=5){
        return response()->json(["postlimit"=>"Telah lebih 5"]);
    }

    $validator = Validator::make($request->all(),[
        'title'=>'required',
        'content'=>'required'
        // 'user_id'=>'unique:posts,user_id',
    ],[
        'title.required'=>'Sila hantar field title',
        // 'user_id.unique'=>'Id pengguna telah wujud'
    ]);

    if($validator->fails()){
        return response()->json($validator->messages());
    }

    $post = Post::create($request->all());

    return response()->json($post);
});

Route::post('posts/{post}', function (Request $request, Post $post) {
    // dd($post);
    // $post->title = $request->title;
    // $post->content = $request->content;
    // $post->user_id = $request->user_id;
    // $post->save();

    $post->update($request->all());

    return response()->json($post);
});


Route::get('/comments', function(){
    $comments=Comment::with('user','post.user')->orderBy('id')->get(); //Eloquent
    if(isset($request->id)){
        $comments=$comments->where('id',$request->id);
    }
    //select * from comments order by created_at
    $data['total']=$comments->count();
    $data['comments']=$comments;
    return response()->json($data);
});


