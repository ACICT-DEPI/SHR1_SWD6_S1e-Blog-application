<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
     public function loadHomePage(){
        $logged_user = Auth::user();
        $data = Post::get();

        // foreach ($data as $user) {
        //      dd($posts = $user->posts; // Access posts for each user
        //     // Do something with $posts
        // }
        // $post_data = Post::get();
        // foreach ($post_data as $post) {
        //     dd($post->user_id); // Access user_id for each post in the collection
        // }

        return view('admin.home-page',compact('logged_user','data'));
        // return view('admin.home-page',compact('logged_user'));
    }
    public function show($id){
        $logged_user = Auth::user();

        $post =Post::findorfail($id);
        return view('admin.show',compact('logged_user','post'));
    }
    public function destroy($id){
        $post = Post::findOrFail($id);

        if ($post) {
            if (!empty($post->photo) && Storage::exists('public/images/'.$post->photo)) {
                // Delete the image from storage
                Storage::delete('public/images/'.$post->photo);
            }

            // Check if the images directory is empty, and delete it if it is
            if (Storage::exists('public/images') && empty(Storage::files('public/images'))) {
                Storage::deleteDirectory('public/images');
            }

            // Delete the post
            Post::destroy($id);
        }

        return redirect()->route('admin.home')->with('msg', 'Deleted successfully');

    }
}
