<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
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
    public function view(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $roleJson = $user->group->permissions;
        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'users', 'add');
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        $roleJson = $user->group->permissions;
         if (!empty($roleJson)) {
             $roleArr = json_decode($roleJson, true);
             $check = isRole($roleArr, 'users', 'edit');
             return $check;
         }


        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        $roleJson = $user->group->permissions;
         if (!empty($roleJson)) {
             $roleArr = json_decode($roleJson, true);
             $check = isRole($roleArr, 'users', 'delete');
             return $check;
         }
        // return $user->id === $model->user_id;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
