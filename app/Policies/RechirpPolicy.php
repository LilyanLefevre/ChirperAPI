<?php

namespace App\Policies;

use App\Models\Rechirp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RechirpPolicy
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
    public function view(User $user, Rechirp $rechirps): bool
    {
        $chirp = $rechirps->chirp()->first();
        $author = $chirp->author()->first();
        return $author->is_visible_for($user);
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
    public function update(User $user, Rechirp $rechirps): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Rechirp $rechirps): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Rechirp $rechirps): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Rechirp $rechirps): bool
    {
        return true;
    }
}
