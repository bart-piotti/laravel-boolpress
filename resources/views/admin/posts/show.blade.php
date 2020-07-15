@extends('layouts.dashboard')
@section('content')
    <a href="{{route('admin.posts.index')}}" class="btn btn-danger" style="display: block;text-align: center; width: 150px; margin: 20px auto;">Go back to list</a>
    <h1>Title: {{$data->title}}</h1>
    <p>{{$data->body}}</p>
    <p><strong>Category: </strong> {{$data->category->name}}</p>
    <p>
        <strong>Tags: </strong>
        @forelse($data->tags as $tag)
            {{$tag->name}}{{$loop->last ? '' : ' - '}}
        @empty
            -
        @endforelse
     </p>
@endsection
