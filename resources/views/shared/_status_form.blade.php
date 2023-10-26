<form action="{{ route('statuses.store') }}" method="post">
    @csrf
    @include('shared._error')
    <textarea class="form-control" rows="5" placeholder="some thread..." name="content">{{ old('content') }}</textarea>
    <div class="text-end">
        <button type="submit" class="btn btn-primary mt-3">发布</button>
    </div>
</form>