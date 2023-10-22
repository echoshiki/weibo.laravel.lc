<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $currentuser, User $user)
    {
        return $currentuser->id === $user->id;
    }

    public function destroy(User $currentuser, User $user)
    {
        return $currentuser->is_admin && $currentuser->id !== $user->id;
    }
}
