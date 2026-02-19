<?php

namespace App\Policies;

use App\Models\Groups as Groups;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GroupPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $roleJson = $user->group->permissions;
        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'groups');
            return $check;
        }
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
            $check = isRole($roleArr, 'groups', 'add');
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Groups $group): bool
    {
        $roleJson = $user->group->permissions;
         if (!empty($roleJson)) {
             $roleArr = json_decode($roleJson, true);
             $check = isRole($roleArr, 'groups', 'edit');
             return $check;
         }
         return false;
        //   return $user->id === $group->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Groups $group): bool
    {
        $roleJson = $user->group->permissions;
        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'groups', 'delete');
            return $check;
        }
         return false;
    }
    //phân quyền
    public function permission(User $user, Groups $group): bool
    {
        $roleJson = $user->group->permissions;
        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'groups', 'permission');
            return $check;
        }
        return false;
    }


}
