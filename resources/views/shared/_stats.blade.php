<a href="{{ route('users.followings', $user->id); }}">
    <strong>
        {{ count($user->followings) }}
    </strong>
    关注
</a>

<a href="{{ route('users.followers', $user->id); }}">
    <strong>
        {{ $user->followers()->count() }}
    </strong>
    粉丝
</a>

<a href="{{ route('users.show', $user->id); }}">
    <strong>
        {{ $user->statuses()->count() }}
    </strong>
    微博
</a>
