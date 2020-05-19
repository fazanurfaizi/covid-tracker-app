<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{

    /**
     * Handle the user "updating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        $user->updated_at = now();
    }
}
