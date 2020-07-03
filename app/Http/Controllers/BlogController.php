<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index() 
    {
        $posts = Post::all();
        return view('blog.index', compact('posts'));
    }
}
