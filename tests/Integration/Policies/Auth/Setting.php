<?php

namespace Tests\Integration\Policies\Auth;

use App\Models\User;

class Setting
{
    /**
     * @param \App\Models\User $user
     * @return bool
     */
    public function activate(User $user)
    {
        return ! $user->hasVerifiedEmail();
    }

    /**
     * @param \App\Models\User $user
     * @return bool
     */
    public function deactivate(User $user)
    {
        return ! $user->trashed();
    }
}