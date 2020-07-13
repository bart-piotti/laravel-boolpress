<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::all();
        return view('admin.posts.index', ['data' => $data]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();
        return redirect()->route('admin.posts.index');
    }


    public function show($id)
    {
        $data = Post::find($id);
        return view('admin.posts.show', ['data' => $data]);
    }


    public function edit($id)
    {
        $data = Post::find($id);
        return view('admin.posts.edit', ['data' => $data]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');
        $up_post = Post::find($id)->fill($data);
        $up_post->update();
        return redirect()->route('admin.posts.index');
    }


    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('admin.posts.index');
    }
}
