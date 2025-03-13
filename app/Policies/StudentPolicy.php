<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use App\Traits\DirectorPermissions;

class StudentPolicy
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
    public function view(User $user, Student $student): bool
    {
        return in_array($student->grade->id, $user->grades->pluck('id')->toArray());
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
    public function update(User $user, Student $student): bool
    {
        return in_array($student->grade->id, $user->grades->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Student $student): bool
    {
        return in_array($student->grade->id, $user->grades->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Student $student): bool
    {
        return in_array($student->grade->id, $user->grades->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Student $student): bool
    {
        return in_array($student->grade->id, $user->grades->pluck('id')->toArray());
    }
}
