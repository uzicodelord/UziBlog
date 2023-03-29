@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card rounded-lg border-0 shadow-sm">
                    <div class="card-body prf">
                        <h1 class="display-4 text-center mb-5">Welcome to Our Blog!</h1>
                        <p class="lead text-center mb-5">Congratulations on logging in! We're so happy to have you here.</p>
                        <p class="text-center">Now that you're a part of our community, you can enjoy access to all of our amazing blog posts, comment on your favorites, and connect with other readers who share your interests.</p>
                        <p class="text-center">So grab a cup of tea, kick back, and let's dive into the world of blogging together!</p>
                        <div class="text-center mt-3">
                            <a class="btn btn-primary" href="{{ route('blog.index') }}">{{ __('Check the Blogs') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
