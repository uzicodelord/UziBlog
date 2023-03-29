@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <div>
                        <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                        <form action="{{ route('blog.destroy', $post->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
                <p class="card-text">{{ $post->body }}</p>
                <p class="card-text"><small class="text-muted">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small></p>
            </div>
        </div>
        <h2 style="color: #fff">Comments</h2>
        @foreach($post->comments as $comment)
            <div class="card mb-3" >
                <div class="card-body">
                    <p class="card-text">{{ $comment->body }}</p>
                    <p class="card-text"><small class="text-muted">Commented by {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y') }}</small></p>
                </div>
            </div>
        @endforeach

        <h3>Add Comment</h3>
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="form-group">
                <label for="body">Comment</label>
                <textarea class="form-control" id="body" name="body"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>
    </div>
@endsection
