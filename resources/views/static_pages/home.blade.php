@extends('layouts.default')

@section('content')
    @include('shared._message')
    @include('shared._error')

    @if (Auth::check())
    
    <div class="row">
        <div class="col-md-8">
            <section class="status_form">
              @include('shared._status_form')
            </section>
            <hr>
            @include('shared._feed')
        </div>
        <aside class="col-md-3 ms-5">
            <section class="user_info">
                @include('shared._user_info', ['user' => Auth::user()])
            </section> 
            <hr>
            <section class="user_stats">
                @include('shared._stats', ['user' => Auth::user()])
            </section>             
        </aside> 
    </div>

    @else
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
    @endif
@stop