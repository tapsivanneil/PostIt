<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class BlogController extends Controller
{
    public function showBlogs(){
        $user=Auth::user();
        return view('/dashboard', 
                    ['blogs' => Blog::with('author')->orderBy('updated_at', 'desc')->get()],
                );
    }

    public function create(){
        return view('/createblog', ['user' => Auth::user()]);
    }

    public function createBlog(Request $request){
        $user=Auth::user();

        $create_sample_blog = Blog::create([
            'user_id' => $user->id,
            'blog_title' => $request->addBlog_title,
            'blog_post' => $request->addBlog_body,
            'blog_likes' => 0,
        ]);

        return view('/dashboard', 
                    ['blogs' => Blog::with('author')->orderBy('created_at', 'desc')->get()],
        );
    }

    public function likePost($id, $user_id){
        $user=Auth::user();

        $fetch_blog_likes = Blog::find($id);
        
        $update_blog_like = Blog::where('id', $id)->update([
            'blog_likes' => $fetch_blog_likes->increment('blog_likes'),
        ]);

        return view('/dashboard', 
            ['blogs' => Blog::with('author')->orderBy('created_at', 'desc')->get()],
        );

    }

}

  // $create_sample_blog = Blog::create([
        //     'user_id' => 1,
        //     'blog_title' => 'A Brand New World',
        //     'blog_post' => 'This is a body of a blog post in PostIt!',
        //     'blog_likes' => 124,
        // ]);

        //return view('/welcome');