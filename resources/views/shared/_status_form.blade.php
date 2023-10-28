<form action="{{ route('statuses.store') }}" method="post" class="_status_form">
    @csrf
    @include('shared._error')
    <textarea class="form-control" rows="5" placeholder="some thread..." name="content">{{ old('content') }}</textarea>
    <div class="text-end">
        <button type="submit" class="btn btn-primary mt-3">发布微博</button>
    </div>
</form>