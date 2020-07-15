@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('posts')}}" class="btn btn-danger" style="display: block;text-align: center; width: 160px; margin: 20px auto;">Go back to posts list</a>
            <h2 style="text-align: center;">{{$data->title}}</h2>
            <p>{{$data->body}}</p>
            <p><strong>Tags: </strong>
                @forelse ($data->tags as $tag)
                    {{$tag->name}}{{ $loop->last ? '' : ' - '}}
                @empty
                    -
                @endforelse
            </p>
        </div>
    </div>
</div>
@endsection
