@extends('layouts.default')

@section('title', '个人信息')

@section('content')
    <div>
        <p class="lead">用户名：{{ $user->name }}</p>
        <p class="lead">邮箱：{{ $user->email }}</p>
        <p class="lead">注册日期：{{ $user->created_at }}</p> 
    </div>
@stop