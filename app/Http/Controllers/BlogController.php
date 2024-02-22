<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\UserLike;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function showBlogs(){
        $user=Auth::user();
        return view('/dashboard', 
                    ['blogs' => Blog::with('author')->orderBy('created_at', 'desc')->get()],
                    ['userLiked' => UserLike::where('user_id', $user->id)->get()],
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

        $increment_blog_likes = Blog::find($id);
        $increment_blog_likes->increment('blog_likes');

        $add_user_like_blog = UserLike::create([
            'user_id' => $user->id,
            "blog_id" => $id,
        ]);

        return redirect('/dashboard');

    }

    public function unlikePost($id, $user_id){
        $user=Auth::user();

        $increment_blog_likes = Blog::find($id);
        $increment_blog_likes->decrement('blog_likes');

        $remove_user_like_blog = UserLike::where('blog_id', $id)->where('user_id', $user-> id)->delete();
        // \Log::info(UserLike::where('blog_id', $id)->where('user_id', $user_id)->toSql());

        return redirect('/dashboard');

    }

    public function deletePost($id){
        $user=Auth::user();

        $remove_user_blog = Blog::where('id', $id)->delete();

        $remove_blog_from_user_like = UserLike::where('blog_id', $id)->delete();
        // \Log::info(UserLike::where('blog_id', $id)->where('user_id', $user_id)->toSql());

        return redirect('/profileview');

    }

}

  // $create_sample_blog = Blog::create([
        //     'user_id' => 1,
        //     'blog_title' => 'A Brand New World',
        //     'blog_post' => 'This is a body of a blog post in PostIt!',
        //     'blog_likes' => 124,
        // ]);

        //return view('/welcome');