@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body prf">
                        <div class="row">
                            <div class="col-md-4">
                                @if ($user->profilePicture())
                                    <img src="{{ $user->profilePicture() }}" alt="{{ $user->name }}" class="img-thumbnail" style="width: 300px;height: 300px;">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h3>{{ $user->name }}</h3>
                                <span style="color: red">Level: {{ $levelData }}</span>
                                <p>Bio: {{ $user->bio }}</p>

                                <hr>
                                <h4>{{ $user->name }}'s Posts:</h4>

                                @if(count($user->posts) > 0)
                                    <div class="post-list">
                                        @foreach ($user->posts as $post)
                                            <div class="post-item">
                                                <a class="btn btn-primary" style="width: 100%;" href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>{{ $user->name }} has not created any posts yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
