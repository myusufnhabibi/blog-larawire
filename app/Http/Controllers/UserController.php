<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home()
    {
        // $user_profile_data = UserProfile::where('user_id',$logged_user->id)->first();
        // $user_image = $user_profile_data->image;
        return view('user.index');
    }

    public function posts()
    {
        // $user_profile_data = UserProfile::where('user_id',$logged_user->id)->first();
        // $user_image = $user_profile_data->image;
        return view('user.my-post');
    }

    public function postCreate()
    {
        // $user_profile_data = UserProfile::where('user_id',$logged_user->id)->first();
        // $user_image = $user_profile_data->image;
        return view('user.create-post');
    }

    public function postEdit($post_id)
    {
        $post_data = Post::find($post_id);
        return view('user.edit-post', compact('post_data'));
    }

    public function postView($post_id)
    {
        $post_data = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->where('posts.id', $post_id)
            ->first(['users.name', 'posts.*']);
        // $user_profile_data = UserProfile::where('user_id',$logged_user->id)->first();
        // $user_image = $user_profile_data->image;
        return view('user.view-post', compact('post_data'));
    }
}
