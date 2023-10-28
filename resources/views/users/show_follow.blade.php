@extends('layouts.default')
@section('title', $title)
    
@section('content')
    <div class="list-group list-group-flush">
        @foreach ($users as $user)
        <div class="list-group-item">
            <a class="text-decoration-none" href="{{ route('users.show', $user) }}">
                {{ $user->name }}
            </a>
        </div>
        @endforeach
    </div>
    {!! $users->render() !!}
@endsection