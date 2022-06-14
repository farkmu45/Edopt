<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{

    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return $admin->isMaster();
    }

    public function view(Admin $admin, Admin $adminInstance)
    {
        return $admin->isMaster() && !$adminInstance->isMaster();
    }


    public function create(Admin $admin)
    {
        return $admin->isMaster();
    }

    public function update(Admin $admin, Admin $adminInstance)
    {
        return $admin->isMaster() && !$adminInstance->isMaster();
    }

    public function delete(Admin $admin, Admin $adminInstance)
    {
       return $admin->isMaster() && !$adminInstance->isMaster();
    }

    public function deleteAny(Admin $admin)
    {
        return false;
    }
}
