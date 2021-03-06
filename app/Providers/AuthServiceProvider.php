<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Article;
use App\Models\Child;
use App\Models\Orphanage;
use App\Models\User;
use App\Policies\AdminPolicy;
use App\Policies\AppointmentPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\ChildPolicy;
use App\Policies\OrphanagePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Admin::class => AdminPolicy::class,
        User::class => UserPolicy::class,
        Orphanage::class => OrphanagePolicy::class,
        Child::class => ChildPolicy::class,
        Appointment::class => AppointmentPolicy::class,
        Article::class => ArticlePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
