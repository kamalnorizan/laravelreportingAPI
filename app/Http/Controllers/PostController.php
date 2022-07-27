<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::where('user_id',Auth::user()->id)->latest()->get();
        if(isset($request->id)){
            $posts=$posts->where('id',$request->id);
        }
        //select * from posts order by created_at

        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->save();

        // $post = Post::create($request->all());

        return response()->json($post);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Post  $post
    //  * @return \Illuminate\Http\Response
    //  */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    public function postsByUser($user_id)
    {
        $user = User::find($user_id);
        return response()->json($user->posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // dd($post);
        // $post->title = $request->title;
        // $post->content = $request->content;
        // $post->user_id = $request->user_id;
        // $post->save();

        $post->update($request->all());

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        // Post::where('id',$id)->first()->delete();
        // Post::find($id)->delete();
        // Post::destroy($id);

        return response()->json(['status'=>'Deleted']);
    }
}
