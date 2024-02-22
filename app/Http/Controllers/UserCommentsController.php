<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserComment;
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
}
