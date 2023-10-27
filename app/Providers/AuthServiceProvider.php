<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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

        Gate::define('alumno', function(){
            $user = Auth::user();
            return ($user->is_admin == 0 && $user->is_teacher == 0);
        });

        Gate::define('admin', function(){
            $user = Auth::user();
            return $user->admin_type == 1;
        });

        Gate::define('admin-coordinador', function(){
            $user = Auth::user();
            if($user->is_admin == 1)
            return $user->admin_type == 1 || $user->admin_type == 2;

            return false;
        });

        Gate::define('admin-division', function(){
            $user = Auth::user();
            if($user->is_admin == 1)
            return $user->admin_type == 1 || $user->admin_type == 5;

            return false;
        });

        Gate::define('admin-division-coordinador', function(){
            $user = Auth::user();
            if($user->is_admin == 1)
            return $user->admin_type == 1 || $user->admin_type == 2 || $user->admin_type == 5;

            return false;
        });

        Gate::define('coordinador', function(){
            $user = Auth::user();
            return $user->admin_type == 2;
        });

        Gate::define('division', function(){
            $user = Auth::user();
            return $user->admin_type == 5 ;
        });

        Gate::define('biblioteca-ce', function(){
            $user = Auth::user();
            return $user->admin_type == 3 || $user->admin_type == 4;
        });

        Gate::define('biblioteca', function(){
            $user = Auth::user();
            return $user->admin_type == 3;
        });

        Gate::define('control-escolar', function(){
            $user = Auth::user();
            return $user->admin_type == 4;
        });
    }
}
