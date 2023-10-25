@extends('layouts.default')

@section('title', '忘记密码')
@section('content')
    <div class="card-body">
        @include('shared._error')
        @include('shared._message')
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('password.email') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email">您的邮箱地址：</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">发送密码重置邮件</button>
            </div>
        </form>
    </div>
@endsection