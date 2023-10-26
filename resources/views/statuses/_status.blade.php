<li class="d-flex mt-4 mb-4">
    <div class="flex-grow-1">
        <h5 class="mt-0 mb-1">
            {{ $user->name }} 
            <small> / {{ $status->created_at->diffForHumans() }}</small>
        </h5>
        {{ $status->content }}
    </div>
</li>