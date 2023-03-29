@extends('layouts.app')

@section('content')
    <meta charset="UTF-8">

    <div class="container rounded-lg p-4">
        <h1 class="text-center mb-4" style="color: white">Blog Posts</h1>
        <form class="text-center mb-4" action="{{ route('blog.create') }}">
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
        <div style="display: flex; justify-content: center;">
            <form action="{{ route('blog.search') }}" method="GET">
                <input type="text" name="query" placeholder=" Search posts..." class="btn btn-primary" style="cursor:text;margin: 10px">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <br>
    @foreach($posts as $index => $post)
            <div class="card mb-3 uzi prf" style="border: 2.5px #657786 solid">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/images/'.$post->user->profile_picture) }}" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px;margin-right: 10px;">
                        <h1><a class="navbar-brand" href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a></h1>
                        <span class="level">Level: {{ $levelData[$post->user->id] }}</span>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">{{ $post->title }}</h5>
                        <form action="{{ route('blog.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @if ($post->user_id == Auth::id())
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @else

                            @endif
                        </form>
                    </div>
                    <p class="card-text">{{ $post->body }}</p>
                    @if ($post->emoji)
                        <p class="card-text">{{ $post->emoji->name }}</p>
                    @endif
                    <hr class="my-4">
                    <p class="card-text mb-0">
                    <form method="POST" action="{{ route('blog.like', $post->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Like</button>
                        @if (!empty($likedByArr[$post->id]))
                            <span class="ml-2"> {{ $likedByArr[$post->id] }} liked this post</span>
                        @endif
                    </form>
                        <small class="text-muted">Posted by {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small>
                    @if ($post->user_id == Auth::id())
                        <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-primary btn-sm ml-2" style="margin: 10px">Edit</a>
                        <a href="{{ route('blog.show', $post->id) }}" class="btn btn-primary btn-sm ml-2">View</a>
                    @else

                    @endif
                    <br><br>
                    <h4>Comments:</h4>

                @foreach($post->comments as $comment)
                        <div class="card mb-3 uzi2 prf" style="border:none;">
                            <div class="card-body" >
                                <h5 class="card-text d-flex align-items-center">
                                    <img src="{{ asset('storage/images/' . $comment->user->profile_picture) }}" alt="{{ $comment->user->name }}" class="rounded-circle mr-2" style="width: 40px; height: 40px;margin-right: 5px;">
                                    <a class="navbar-brand" href="{{ route('profile.show', $post->user->id) }}">{{ $comment->user->name }}</a>
                                </h5>

                                <p>{{ $comment->body }}</p>
                                <p class="card-text">
                                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                                </p>
                                @if ($comment->user_id == Auth::id())
                                    <a href="{{ route('comments.edit', [$post->id, $comment->id]) }}" class="btn btn-primary btn-sm mt-2">Edit Comment</a>
                                    <a href="{{ route('comments.destroy', [$post->id, $comment->id]) }}" class="btn btn-danger btn-sm mt-2" style="margin-left: 10px">Delete Comment</a>
                                @else

                                @endif
                            </div>
                        </div>
                    @endforeach
                    <hr class="my-4">
                    <h4>Add Comment</h4>
                    <form action="{{ route('comments.store', $post->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-group">
                            <label for="body">Comment</label>
                            <textarea class="form-control" id="body" name="body"></textarea><br>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </form>
                </div>
            </div>

        @endforeach
    </div>
    <br>
    <div class="d-flex justify-content-center" style="height: 10px;">
    {{ $posts->links() }}
    </div>
@endsection

