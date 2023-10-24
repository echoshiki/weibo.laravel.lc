<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->created_at }}</td>
    <td>
        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary">个人中心</a>
        @can('update', $user)
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-success">修改</a>
        @endcan
        @can('destroy', $user)
        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
        </form>
        @endcan
    </td>
</tr>