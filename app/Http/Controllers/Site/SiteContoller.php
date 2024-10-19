<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SiteContoller extends Controller
{
    public function index(){
        //posts (title-content-userName -comments-createdAt)

        $posts = Post::OrderBy('created_at','desc')->paginate(6);
        // foreach ($posts as $post) {
        //     # code...
        //     $commentCounter = count($post->comments);
        //     echo $commentCounter;
        // } //to get count
        return view('site.index',compact('posts'));
    }

    public function show($id){
        //post(photo-post_title,created_at,username,content),comment(username,userimage,comment_details,created_at),posts(image,title,some of content)->make paginate 3 posts only
        $post = Post::find($id);
        $posts = Post::orderBy('created_at','desc')->limit(3)->get();

        return view('site.post',compact('post','posts'));
    }
}
