<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;


    public function viewAny(Admin $admin)
    {
        return $admin->isMaster;
    }


    public function view(Admin $admin, Article $article)
    {
        return $admin->isMaster;
    }


    public function create(Admin $admin)
    {
        return $admin->isMaster;
    }


    public function update(Admin $admin, Article $article)
    {
        return $admin->isMaster;
    }


    public function delete(Admin $admin, Article $article)
    {
        return $admin->isMaster;
    }



    public function deleteAny(Admin $admin, Article $article)
    {
        return $admin->isMaster;
    }
}
