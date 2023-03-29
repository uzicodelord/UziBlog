@extends('layouts.app')

@section('content')
    <div class="container" style="color: #fff">
        <h1 >Create Blog Post</h1>
        <form action="{{ route('blog.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <br>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" required></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Create Post</button>
            <label>
                <select name="emoji_id" class="form-select">
                    <option value="">Choose an emoji</option>
                    @foreach ($emojis as $emoji)
                        @if (Auth::user()->points >= $emoji->level)
                            <option value="{{ $emoji->id }}">
                                {{ $emoji->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </label>
            <p>Create more blogs to unlock more emojis</p>
        </form>
    </div>
@endsection
