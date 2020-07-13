@extends('layouts.dashboard');
@section('content')
        <h1 style="display: inline;">Posts list</h1>
        <a style="display: inline; margin-left: 20px; vertical-align: super;" href="{{route('admin.posts.create')}}" class="btn btn-primary">Write a new post</a>

    <table style="width:85%; margin: auto; text-align: center; margin-top: 20px;">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Body</th>
        <th>Slug</th>
      </tr>
      @foreach ($data as $post)
      <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->title}}</td>
        <td>{{$post->body}}</td>
        <td>{{$post->slug}}</td>
        <td>
            <a href="{{ route('admin.posts.show', ['post' => $post->id ]) }}" class="btn btn-info" style="color:white;" >Show details</a>
            <a href="{{ route('admin.posts.edit', ['post' => $post->id ]) }}" class="btn btn-warning" style="color:white;">Edit</a>
            <form id="delete_form" action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post" class="d-inline">
                @method('DELETE')
                @csrf
                <button type="submit" name="button" class="btn btn-danger">Delete</button>
            </form>
        </td>
      </tr>
      @endforeach
    </table>
@endsection
