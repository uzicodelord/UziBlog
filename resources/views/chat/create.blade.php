@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>New Conversation</h1>

        <form method="post" action="{{ route('chat.store') }}">
            @csrf

            <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">

            <div class="form-group">
                <label for="body">Message:</label>
                <textarea name="body" id="body" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
@endsection
