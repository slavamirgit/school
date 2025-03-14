<?php

namespace App\Policies;

use App\Models\Grade;
use App\Models\User;
use App\Traits\DirectorPermissions;

class GradePolicy
{
    use DirectorPermissions;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Grade $grade): bool
    {
        return in_array($grade->id, $user->grades->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Grade $grade): bool
    {
        return in_array($grade->id, $user->grades->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Grade $grade): bool
    {
        return in_array($grade->id, $user->grades->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Grade $grade): bool
    {
        return in_array($grade->id, $user->grades->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Grade $grade): bool
    {
        return in_array($grade->id, $user->grades->pluck('id')->toArray());
    }
}
