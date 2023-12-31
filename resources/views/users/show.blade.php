@extends('layouts.default')

@section('title', '个人信息')

@section('content')
    @include('shared._message')
    <section class="user_info">@include('shared._user_info')</section>
    @include('users._follow_form')
    <hr>
    <section class="user_stats">@include('shared._stats')</section>
    <hr>
    <section class="status">
        @if (count($statuses) > 0)
        <ul class="list-unstyled">
            @foreach ($statuses as $status)
                @include('statuses._status')
            @endforeach
        </ul>
        <div class="mt-3">
            {!! $statuses->render() !!}
        </div>
        @else
        <p>没有任何数据！</p>
        @endif
    </section>
@stop