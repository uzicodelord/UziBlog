@extends('layouts.app')

@section('content')
    <div class="container" style="color: #fff">
        <h1>Edit Blog Post</h1>

        <form action="{{ route('blog.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body">{{ $post->body }}</textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection
