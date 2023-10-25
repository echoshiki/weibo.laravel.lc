@extends('layouts.default')

@section('title', '重置密码')
@section('content')
    <div class="card-body">
        @include('shared._message')
        @include('shared._error')
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3">
                <label for="email">邮箱地址：</label>
                <input type="text" name="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $email ?? old('email') }}" required autofocus>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="password">输入新密码</label>
                <input type="password" name="password" id="password" class="form-control" value="" required>
            </div>
            <div class="mb-3">
                <label for="password-confirm">重复新密码</label>
                <input type="password" name="password_confirmation" id="password-confirm" class="form-control" value="" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">提交重置</button>
            </div>
        </form>
    </div>
@endsection