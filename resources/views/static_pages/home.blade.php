@extends('layouts.default')

@section('content')
    <p class="lead">你现在所看到的是 <a href="https://learnku.com/courses/laravel-essential-training">Laravel 入门教程</a> 的示例项目主页。</p>
    <p>一切，将从这里开始。</p>
    @if (Auth::check())
    <hr>
    <h3> 您好，{{ Auth::user()->name }} ！ </h3>
    @else
    <p>
        <a class="btn btn-lg btn-primary" href="{{route('login')}}" role="button">登陆</a>
        <a class="btn btn-lg btn-success" href="{{route('users.create')}}" role="button">现在注册</a>
    </p>
    @endif
@stop