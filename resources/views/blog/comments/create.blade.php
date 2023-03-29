@extends('layouts.app')

@section('content')
    <h1>Create Comment</h1>

    <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="body">Comment</label>
            <textarea class="form-control" id="body" name="body"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Comment</button>
    </form>
@endsection
