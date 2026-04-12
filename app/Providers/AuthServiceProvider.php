<?php

namespace App\Providers;

use App\Models\News;
use App\Models\User;
use App\Models\Event;
use App\Models\Resource;
use App\Policies\NewsPolicy;
use App\Policies\EventPolicy;
use App\Policies\ResourcePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        News::class => NewsPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-admin', function ($user) {
            return $user->isAdmin() || $user->isTeacher();
        });
        Gate::define('access-teacher', function (User $user) {
            return $user->isTeacher();
        });
    }
}