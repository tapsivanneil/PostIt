<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    protected $fillable = ['user_id','blog_title', 'blog_post', 'blog_likes'];
    use HasFactory;
}
