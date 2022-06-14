<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Orphanage;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrphanagePolicy
{
    use HandlesAuthorization;

    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return $admin->isMaster();
    }

    public function view(Admin $admin, Orphanage $orphanage)
    {
        return $admin->isMaster();
    }


    public function create(Admin $admin)
    {
        return $admin->isMaster();
    }

    public function update(Admin $admin, Orphanage $orphanage)
    {
        return $admin->isMaster();
    }

    public function delete(Admin $admin, Orphanage $orphanage)
    {
        return $admin->isMaster();
    }

    public function deleteAny(Admin $admin)
    {
        return $admin->isMaster();
    }
}
