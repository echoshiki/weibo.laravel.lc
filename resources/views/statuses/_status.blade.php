<li class="d-flex mt-4 mb-4">
    <div class="flex-grow-1">
        <h5 class="mt-0 mb-1">
            {{ $user->name }} 
            <small> / {{ $status->created_at->diffForHumans() }}</small>
        </h5>
        {{ $status->content }}
    </div>
    @can('destroy', $status)
    <div>
        <form action="{{ route('statuses.destroy', $status) }}" method="post" onsubmit="return confirm('确定删除这条微博么？')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" style="width: 60px;">删除</button>
        </form>
    </div>
    @endcan
</li>