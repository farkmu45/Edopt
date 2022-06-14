<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Appointment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return true;
    }

    public function view(Admin $admin, Appointment $appointment)
    {
        if ($admin->isMaster()) {
            return true;
        } else if ($admin->orphanage_id == $appointment->child->orphanage_id) {
            return true;
        } else {
            return false;
        }
    }


    public function create(Admin $admin)
    {
        return false;
    }

    public function update(Admin $admin, Appointment $appointment)
    {
        if ($admin->isMaster()) {
            return true;
        } else if ($admin->orphanage_id == $appointment->child->orphanage_id) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(Admin $admin, Appointment $appointment)
    {
        if ($admin->isMaster()) {
            return true;
        } else if ($admin->orphanage_id == $appointment->child->orphanage_id) {
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
