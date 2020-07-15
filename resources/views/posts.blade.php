@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($data as $post)
            <div class="col-md-8" style="background:white;padding: 15px;border-radius: 5px;margin-bottom: 20px;">
                <p>{{substr($post->created_at, 0, 10)}}</p>
                <p><strong>Tags: </strong>
                    @forelse ($post->tags as $tag)
                        {{$tag->name}}{{ $loop->last ? '' : ' - '}}
                    @empty
                        -
                    @endforelse
                </p>
                <h2>{{$post->title}}</h2>
                <p>{{$post->body}}</p>
                <a href="{{route('post', ['slug' => $post->slug])}}">Show post</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
