<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function viewAny(Admin $admin)
    {
        return $admin->isMaster();
    }


    public function view(Admin $admin, User $user)
    {
        return $admin->isMaster();
    }


    public function create(Admin $admin)
    {
        return $admin->isMaster();
    }


    public function update(Admin $admin, User $user)
    {
        return $admin->isMaster();
    }


    public function delete(Admin $admin, User $user)
    {
        return $admin->isMaster();
    }

    public function deleteAny(Admin $admin)
    {
        return $admin->isMaster();
    }
}
