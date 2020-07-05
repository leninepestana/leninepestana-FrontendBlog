<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    protected $limit = 3;
    
    public function index() 
    {
        $categories = Category::with(['posts' => function($query) {
            $query->where('published_at', "<=", Carbon::now());
        }])->orderBy('title', 'asc')->get();
        
        //\DB::enableQueryLog();
        $posts = Post::with('author')
                    ->latestFirst()
                    ->published()
                    ->simplePaginate($this->limit);
        return view('blog.index', compact('posts', 'categories'));
        //view('blog.index', compact('posts'))->render();
        //dd(\DB::getQueryLog());
    }
    /*
    public function show($id)
    {
        $post = Post::published()->findOrFail($id);
        return view('blog.show', compact('post'));
    }
    */
    public function show(Post $post)
    {       
        //$post = Post::published()->findOrFail($id);
        return view('blog.show', compact('post'));
    }


    public function category(Category $category) 
    {
        $categoryName = $category->title;
        
        $categories = Category::with(['posts' => function($query) {
            //$query->where('published_at', "<=", Carbon::now());
            $query->published();
        }])->orderBy('title', 'asc')->get();
        
        //\DB::enableQueryLog();
     
        $posts = $category->posts()
                          ->with('author')
                          ->latestFirst()
                          ->published()
                          ->simplePaginate($this->limit);

        return view('blog.index', compact('posts', 'categories', 'categoryName'));
        //view('blog.index', compact('posts', 'categories'))->render();
        //dd(\DB::getQueryLog());
    }
}
