<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    public function index(){
        $data = Post::with('tags', 'category')->get();
        return view('posts', ['data' => $data]);
    }
    public function show($slug){
        $data = Post::where('slug', $slug)->first();
        $tags = Tag::all();
        if($data){
            return view('post', ['data' => $data, 'tags' => $tags]);
        } else {
            return abort('404');
        }
    }
}
