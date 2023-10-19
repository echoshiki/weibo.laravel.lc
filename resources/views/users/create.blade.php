@extends('layouts.default')

@section('title', '注册页 Register')

@section('content')
    <div class="card-body">
        @include('shared._error')
        <form action="{{ route('users.store') }}" method="POST">
            {{csrf_field()}}
            <div class="mb-3">
                <label for="name">名称：</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="email">邮箱：</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="password">密码：</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password_confirmation">确认密码：</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">提交</button>
        </form>
    </div>
@stop

