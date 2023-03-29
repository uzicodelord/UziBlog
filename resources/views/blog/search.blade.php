
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    @if($posts->count())
                        <h3>Search Results:</h3>
                        @foreach($posts as $post)
                            <h4>{{ $post->title }}</h4>
                            <p>{{ $post->excerpt }}</p>
                            <a href="{{ route('blog.show', $post->id) }}" class="btn btn-primary btn-sm mr-2">Read More</a>
                        @endforeach
                    @else
                        <p>No results found.</p>
    @endif
@endsection
