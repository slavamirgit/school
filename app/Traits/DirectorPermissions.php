<?php

namespace App\Traits;

use App\Models\User;

trait DirectorPermissions
{
    public function before(User $user): bool|null
    {
        if ($user->isDirector()) {
            return true;
        }

        return null;
    }
}
