<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user) {
        $this->authorize('follow', $user);
        /** @var \App\Models\User $currentUser **/
        $currentUser = Auth::user();
        if (!$currentUser->isFollowing($user->id)) {
            $currentUser->follow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user) {
        $this->authorize('follow', $user);
        /** @var \App\Models\User $currentUser **/
        $currentUser = Auth::user();
        if ($currentUser->isFollowing($user->id)) {
            $currentUser->unfollow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }
}
