@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Comment</h1>
        <form action="{{ route('comments.update', [$post->id, $comment->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="body">Comment</label>
                <textarea class="form-control" id="body" name="body">{{ $comment->body }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
        <h1>Delete Comment</h1>
        <p>Are you sure you want to delete this comment?</p>
        <form action="{{ route('comments.destroy', [$post->id, $comment->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
