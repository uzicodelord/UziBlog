@extends('layouts.app')

@section('content')
    <div class="container" style="color: #fff">
        <h1>Create New Todo Item</h1>
        <form method="POST" action="{{ route('saveItem') }}">
            @csrf
            <div class="form-group">
                <label for="listItem">Todo Item</label>
                <input type="text" class="form-control @error('listItem') is-invalid @enderror" name="listItem" value="{{ old('listItem') }}" required autofocus>
                @error('listItem')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Save Item</button>
        </form>
        <hr>
        <h1>Todo List Items</h1>
        <table class="table table-bordered" style="color: #fff">
            <thead>
            <tr>
                <th>Item</th>
                <th>Mark as Done</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listItems as $listItem)
                <tr>
                    <td>{{ $listItem->name }}</td>
                    <td>
                        <form method="POST" action="{{ route('markDone', $listItem->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Done</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
