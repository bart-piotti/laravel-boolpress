@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{route('admin.posts.index')}}" class="btn btn-danger" style="display: block;text-align: center; width: 150px; margin: 20px auto;">Go back to list</a>
                <h1>Create a new post</h1>
                    <form action="{{ route('admin.posts.store') }}" method="post">
                        @csrf {{-- IMPORTANTE --}}
                        <div class="form-group">
                           <label for="title">Title</label>
                           <input type="text" name="title" class="form-control" id="title" placeholder="Post title" value="{{ old('title') }} ">
                           @error ('title')
                               <small class="text-danger">{{ $message }}</small>
                           @enderror
                        </div>
                        <div class="form-group">
                           <label for="body">Body</label>
                           <input type="textarea" name="body" class="form-control" id="body" placeholder="Post's body" value="{{ old('body') }} "></input>
                           @error ('body')
                               <small class="text-danger">{{ $message }}</small>
                           @enderror
                        </div>
                        <div class="form-group">
                           <label for="category">Category</label>
                           <select id="category" class="form-control" name="category_id">
                               <option value="">Seleziona categoria</option>
                               @foreach ($categories as $category)
                                   <option value="{{$category->id}}">{{$category->name}}</option>
                               @endforeach
                           </select>
                           @error ('category_id')
                               <small class="text-danger">{{ $message }}</small>
                           @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
