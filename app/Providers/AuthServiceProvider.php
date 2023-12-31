<?php

namespace App\Providers;

use App\Category;
use App\Policies\CategoryPolicy;
use App\Policies\PostPolicy;
use App\Policies\ProfilePolicy;
use App\Policies\UserPolicy;
use App\Post;
use App\Profile;
use App\User;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Category::class => CategoryPolicy::class,
        Post::class => PostPolicy::class,
        Profile::class => ProfilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('viewAdminDashboard', function(User $user) {
            return $user->hasRole('admin') || $user->hasRole('author');
        });

        Gate::define('addAuthors', function(User $user) {
            return $user->hasRole('admin');
        });

        Gate::define('addTrusted', function(User $user) {
            return $user->hasRole('admin');
        });

        Gate::define('addAdmins', function(User $user) {
            return $user->email == "sahajemast@gmail.com";
        });
    }
}
