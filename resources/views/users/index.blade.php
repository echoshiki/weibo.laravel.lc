@extends('layouts.default')

@section('title', '用户列表')

@section('content')
    @include('shared._message')
    @include('shared._error')

    <table class="table table-striped">
        <thead>
            <th>ID</th>
            <th>姓名</th>
            <th>邮箱</th>
            <th>注册时间</th>
            <th>操作</th>
        </thead>
        <tbody>
            @foreach($users as $user)
            @include('users._user')
            @endforeach
        </tbody>
    </table>
    <div class="mb-3">
        {!! $users->render(); !!}
    </div>

@stop

