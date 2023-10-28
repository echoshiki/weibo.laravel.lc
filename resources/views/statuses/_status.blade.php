<li class="d-flex mt-4 mb-4 _status_item">
    <a class="flex-shrink-0 _status_gravatar" href="{{ route('users.show', $user->id )}}">
        <img src="{{ $user->gravatar(72) }}" alt="{{ $user->name }}" class="me-1 gravatar"/>
    </a>
    <div class="flex-grow-1 _status_content">
        <h5 class="mt-0 mb-1">
            {{ $user->name }} 
            <small> / {{ $status->created_at->diffForHumans() }}</small>
        </h5>
        {{ $status->content }}
    </div>
    @can('destroy', $status)
    <div class="_status_control">
        <form action="{{ route('statuses.destroy', $status) }}" method="post" onsubmit="return confirm('确定删除这条微博么？')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" style="width: 60px;">删除</button>
        </form>
    </div>
    @endcan
</li>