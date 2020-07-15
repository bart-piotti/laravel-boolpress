<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::with('category', 'tags')->get();
        return view('admin.posts.index', ['data' => $data]);
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', ['categories' => $categories, 'tags' => $tags]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);
        $data = $request->all();
        $slug = Str::slug($data['title'], '-');
        $slug_originale = $slug;
        // verifico che lo slug sia unico
        $post_trovato = Post::where('slug', $slug)->first();
        $contatore = 0;
        while($post_trovato) {
            $contatore++;
            // genero un nuovo slug concatenando un contatore
            $slug = $slug_originale . '-' . $contatore;
            $post_trovato = Post::where('slug', $slug)->first();
        }
        $data['slug'] = $slug;
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();
        if (!empty($data['tags'])) {
            $new_post->tags()->sync($data['tags']);
        }
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
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', [
            'data' => $data,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);
        $data = $request->all();
        $slug = Str::slug($data['title'], '-');
        $slug_originale = $slug;
        $isThereEqualSlug = Post::where('slug', $slug)->first();
        $contatore = 0;
        while ($isThereEqualSlug) {
            $contatore++;
            $slug = $slug_originale . '-' . $contatore;
            $isThereEqualSlug = Post::where('slug', $slug)->first();
        }
        $data['slug'] = $slug;
        $up_post = Post::find($id)->fill($data);
        $up_post->update();
        if (!empty($data['tags'])) {
            $up_post->tags()->sync($data['tags']);
        } else {
            $up_post->tags()->detach();
        }
        return redirect()->route('admin.posts.index');
    }


    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('admin.posts.index');
    }
}
