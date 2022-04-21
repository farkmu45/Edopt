<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create()
    {
        return auth()->user()->isMaster();
    }

    public function view()
    {
        return auth()->user()->isMaster();
    }

    public function viewAny()
    {
        return auth()->user()->isMaster();
    }

    public function update()
    {
        return auth()->user()->isMaster();
    }

    public function delete()
    {
        return auth()->user()->isMaster();
    }

    public function deleteAny()
    {
        return auth()->user()->isMaster();
    }
}
