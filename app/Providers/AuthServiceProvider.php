<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('is-superadmin', function ($user) {
            return $user->isSuperAdmin();
        });



        Gate::define('is-admin', function ($user) {
            return $user->isAdmin();
        });
        Gate::define('is-admin-only', function ($user) {
            return $user->isAdminOnly();
        });



        Gate::define('is-guidance', function ($user) {
            return $user->isGuidance();
        });
        Gate::define('is-guidance-only', function ($user) {
            return $user->isGuidanceOnly();
        });



        Gate::define('is-student', function ($user) {
            return $user->isStudent();
        });
        Gate::define('is-student-only', function ($user) {
            return $user->isStudentOnly();
        });

        Gate::define('can-view-posts', function ($user) {
            return $user->canViewPosts();
        });
    }
}
