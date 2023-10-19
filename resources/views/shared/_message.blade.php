@foreach (['success', 'danger', 'warning', 'notice'] as $msg)
    @if (session()->has($msg))
        <div class="alert alert-{{ $msg }}">
            {{ session($msg) }}
        </div>
    @endif
@endforeach