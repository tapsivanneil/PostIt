<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserComment extends Model
{
    protected $fillable = ['user_id','blog_id', 'comment'];
    use HasFactory;
}
