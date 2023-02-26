<?php

namespace App\Providers;

use App\Repository\Role\IRoleRepository;
use App\Repository\Role\RoleRepository;
use App\Repository\User\IUserRepository;
use App\Repository\User\UserRepository;
use App\Services\Role\IRoleService;
use App\Services\Role\RoleService;
use App\Services\User\IUserService;
use App\Services\User\UserService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SineasHubProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(IUserService::class,UserService::class);
        $this->app->singleton(IUserRepository::class,UserRepository::class);

        $this->app->singleton(IRoleService::class, RoleService::class);
        $this->app->singleton(IRoleRepository::class, RoleRepository::class);
    }

    public function provides()
    {
        return [
            IUserService::class,
            IUserRepository::class,
            IRoleService::class,
            IRoleRepository::class
        ];
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
