<?php

namespace App\Policies;

use App\Models\Photo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
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

    public function owner(User $user, Photo $photo)
    {
        return $user->id === $photo->user_id;
    }
}
