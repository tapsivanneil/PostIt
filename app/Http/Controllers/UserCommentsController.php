<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserComment;
use App\Models\UserLike;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;


class UserCommentsController extends Controller
{
    public function commentBlog($id, Request $request){
        $user = Auth::user();
        $add_comment = UserComment::create([
            'user_id' => $user->id,
            'blog_id' => $id,
            'comment' => $request->user_comment,
        ]);

        return redirect('/dashboard');
    }

    public function commentBlogStay($id, Request $request){
        $user = Auth::user();
        $add_comment = UserComment::create([
            'user_id' => $user->id,
            'blog_id' => $id,
            'comment' => $request->user_comment,
        ]);

        return view('/comments', [
            'comments'=> UserComment::where('blog_id', $id)->get(),
            'blogs'=> Blog::join('users', 'users.id', '=', 'blogs.user_id')->where('blogs.id', $id)->get(),
            'userLiked' => UserLike::where('user_id', $user->id)->get(),
            'blogs_id' =>Blog::find($id),
        ]);
    }

    public function viewComments($id){
        $user = Auth::user();

        return view('/comments', [
                    'comments'=> UserComment::where('blog_id', $id)->get(),
                    'blogs'=> Blog::join('users', 'users.id', '=', 'blogs.user_id')->where('blogs.id', $id)->get(),
                    'userLiked' => UserLike::where('user_id', $user->id)->get(),
                    'blogs_id' =>Blog::find($id),
                ]);
        
    }

}
