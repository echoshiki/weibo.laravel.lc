@extends('layouts.default')

@section('title', '登陆页 Login')

@section('content')
    <div class="card-body">
        @include('shared._error')
        @include('shared._message')
        <form action="{{ route('login') }}" method="POST">
            {{csrf_field()}}
            <div class="mb-3">
                <label for="email">邮箱：</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="password">密码：</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Login Now</button>
        </form>
        <hr>
        <p>还没账号？<a href="{{ route('users.create') }}">现在注册！</a></p>
    </div>
@stop

