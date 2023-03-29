<div class="card">
    <div class="card-header">{{ $conversation->name }}</div>
    <div class="card-body">
        <ul>
            @foreach ($messages as $message)
                <li>
                    {{ $message->user->name }}: {{ $message->body }}
                </li>
            @endforeach
        </ul>
        <form method="POST" action="{{ route('chat.store') }}">
            @csrf
            <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
            <div class="form-group">
                <textarea class="form-control" name="body" rows="3" placeholder="Type your message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
        </form>
    </div>
</div>
