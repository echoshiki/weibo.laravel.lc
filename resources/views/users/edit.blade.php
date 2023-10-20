@extends('layouts.default')

@section('title', '资料修改')
@section('content')
    @include('shared._error')
    @include('shared._message')
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name">名称</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">  
        </div> 
        <div class="mb-3">
            <label for="email">邮箱：</label>
            <input type="text" name="email" class="form-control" value="{{ $user->email }}" disabled>
        </div>

        <div class="mb-3">
            <label for="password">密码：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>

        <div class="mb-3">
            <label for="password_confirmation">确认密码：</label>
            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
        </div>  
        
        <button class="btn btn-primary" type="submit">确定修改</button>     
    </form>

@endsection
