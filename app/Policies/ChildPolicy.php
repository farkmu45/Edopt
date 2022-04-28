<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Child;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChildPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, Child $child)
    {
        if ($admin->isMaster) {
            return true;
        } else if ($admin->orphanage_id == $child->orphanage_id) {
            return true;
        } else {
            return false;
        }
    }


    public function create(Admin $admin)
    {
        return true;
    }

    public function update(Admin $admin, Child $child)
    {
        if ($admin->isMaster) {
            return true;
        } else if ($admin->orphanage_id == $child->orphanage_id) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(Admin $admin, Child $child)
    {
        if ($admin->isMaster) {
            return true;
        } else if ($admin->orphanage_id == $child->orphanage_id) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAny(Admin $admin)
    {
        return true;
    }
}
