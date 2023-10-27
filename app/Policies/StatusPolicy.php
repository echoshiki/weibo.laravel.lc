<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Status;

class StatusPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Status $status) {
        return $user->id === $status->user_id;
    }
}
