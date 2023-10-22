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