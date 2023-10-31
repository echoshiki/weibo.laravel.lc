@extends('layouts.default')
@section('title', $title)
    
@section('content')
    <div class="list-group list-group-horizontal flex-fill">
        @foreach ($users as $user)
        <div class="list-group-item ">
            <div class="avatar"><img src="{{ $user->gravatar(100); }}" /></div>
            <a class="text-decoration-none" href="{{ route('users.show', $user) }}">
                {{ $user->name }}
            </a>
        </div>
        @endforeach
    </div>
    <hr>
    {!! $users->render() !!}
@endsection