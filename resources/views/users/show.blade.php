@extends('layouts.default')

@section('title', '个人信息')

@section('content')
<div class="bg-light p-3 p-sm-5 rounded">
    <div>
        <p class="lead">用户名：{{ $user->name }}</p>
        <p class="lead">邮箱：{{ $user->email }}</p>
        <p class="lead">注册日期：{{ $user->created_at }}</p> 
    </div>
</div>
     
@stop