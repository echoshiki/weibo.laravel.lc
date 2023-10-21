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
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary">个人中心</a>
                    {{-- <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-success">修改</a>
                    <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-sm btn-danger">删除</a> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@stop

