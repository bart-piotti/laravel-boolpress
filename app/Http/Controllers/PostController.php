<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(){
        $data = Post::all();
        return view('posts', ['data' => $data]);
    }
    public function show($slug){
        $data = Post::where('slug', $slug)->first();
        if($data){
            return view('post', compact('data'));
        } else {
            return abort('404');
        }
    }
}
