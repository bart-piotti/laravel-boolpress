@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>Blog Homepage for users</p>
            <a href="{{route('posts')}}" class="btn btn-primary" style="display: block;text-align: center; width: 150px; margin: 20px auto;">See all posts</a>
        </div>
    </div>
</div>
@endsection
