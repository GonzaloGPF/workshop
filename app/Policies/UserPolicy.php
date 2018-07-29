<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can update the thread.
     *
     * @param  \App\User  $user
     * @param  \App\User  $userProfile
     * @return mixed
     */
    public function update(User $user, User $userProfile)
    {
        return $user->id == $userProfile->id;
    }

    /**
     * Determine whether the user can delete the thread.
     *
     * @param  \App\User  $user
     * @param  \App\User  $userProfile
     * @return mixed
     */
    public function delete(User $user, User $userProfile)
    {
        return $user->id == $userProfile->id;
    }
}
