<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $user->updated_at = date('Y-m-d G:i:s');
    }
}
