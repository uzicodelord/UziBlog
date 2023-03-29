@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Chat Conversations') }}</div>
                    <div class="card-body">
                        <ul>
                            @foreach ($conversations as $conversation)
                                <li>
                                    <a href="{{ route('chat.show', $conversation->id) }}">{{ $conversation->name }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-3">
                            <a href="{{ route('chat.create', Auth::user()->id) }}" class="btn btn-primary">
                                {{ __('New Conversation') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
