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
    public function index(){

        $logged_user = Auth::user();
        $user_profile_data = UserProfile::where('user_id',$logged_user->id)->first();

        $user_image = $user_profile_data->image;
        $data = Post::get();
        $users = User::get();
        return view('admin.users',compact('users','logged_user','user_image','data'));
    }

    public function showUser($id){
        $logged_user = Auth::user();
        $user_profile_data = UserProfile::where('user_id',$logged_user->id)->first();
        $user_image = $user_profile_data->image;
        $data = Post::get();
        $users = User::get();

        $user =User::findorfail($id);
        $userDetails = UserProfile::findorfail($id);
        // return $userDetails;
        return view('admin.showUser',compact('logged_user','user','user_image','users','data','userDetails'));
    }
    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user_profile_data = UserProfile::where('user_id',$user->id)->first();
        $user_image = $user_profile_data->image;
        if ($user) {
            if (!empty($user_image) && Storage::exists('public/images/'.$user_image)&& $user_image !="avatar.jpg") {
                // Delete the image from storage
                Storage::delete('public/images/'.$user_image);
            }

            // Check if the images directory is empty, and delete it if it is
            if (Storage::exists('public/images') && empty(Storage::files('public/images'))) {
                Storage::deleteDirectory('public/images');
            }


        }
        User::destroy($id);

        return redirect()->route('admin.users')->with('msg', 'Deleted successfully');

    }

    public function SwitchToAdmin(Request $request,$id){
        $user = User::findorfail($id);
        // return $user;
        $user->role =1;
        $user->save();
        return redirect()->route('admin.users');

    }
    public function SwitchToUser($id){
        $user = User::findorfail($id);
        // return $user;
        $user->role = 0;
        $user->save();
        return redirect()->route('admin.users');

    }








    //post page
     public function loadHomePage(){
        $logged_user = Auth::user();
        $data = Post::get();
        $users = User::get();
        $user_profile_data = UserProfile::where('user_id',$logged_user->id)->first();
        $user_image = $user_profile_data->image;


        return view('admin.home-page',compact('logged_user','data','user_image','users'));

    }
    public function show($id){
        $logged_user = Auth::user();
        $user_profile_data = UserProfile::where('user_id',$logged_user->id)->first();
        $data = Post::get();
        $users = User::get();
        $user_image = $user_profile_data->image;
        $post =Post::findorfail($id);
        return view('admin.show',compact('logged_user','post','user_image','data','users'));
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
