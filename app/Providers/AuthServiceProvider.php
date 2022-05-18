<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('user', function (User $user) {
            return $user->type_user === 'user';
        });

        Gate::define('product', function (User $user) {

            if ($user->permission) {
                return $user->permission->product_permission == 1;
            }
            return false;
        });

        Gate::define('brand', function (User $user) {

            if ($user->permission) {
                return $user->permission->brand_permission == 1;
            }
            return false;
        });

        Gate::define('category', function (User $user) {

            if ($user->permission) {
                return $user->permission->category_permission == 1;
            }
            return false;
        });
    }
}
