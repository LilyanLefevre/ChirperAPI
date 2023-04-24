<?php

namespace App\Policies;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FollowPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Follow $follow): bool
    {
        $follower = $follow->follower()->first();
        $followed = $follow->followed()->first();
        return $follower->is_visible_for($user) || $followed->is_visible_for($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Follow $follow): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Follow $follow): bool
    {
        return $follow->follower_id == $user->id || $follow->followed_id == $user->id;
    }
}
