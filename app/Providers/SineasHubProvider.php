<?php

namespace App\Providers;

use App\Repository\Film\FilmRepository;
use App\Repository\Film\IFilmRepository;
use App\Repository\genre\GenreRepository;
use App\Repository\genre\IGenreRepository;
use App\Repository\Role\IRoleRepository;
use App\Repository\Role\RoleRepository;
use App\Repository\Tax\ITaxRepository;
use App\Repository\Tax\TaxRepository;
use App\Repository\User\IUserRepository;
use App\Repository\User\UserRepository;
use App\Services\Film\FilmService;
use App\Services\Film\IFilmService;
use App\Services\genre\GenreService;
use App\Services\genre\IGenreService;
use App\Services\Role\IRoleService;
use App\Services\Role\RoleService;
use App\Services\Tax\ITaxService;
use App\Services\Tax\TaxService;
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
        $this->app->singleton(IUserService::class, UserService::class);
        $this->app->singleton(IUserRepository::class, UserRepository::class);

        $this->app->singleton(IRoleService::class, RoleService::class);
        $this->app->singleton(IRoleRepository::class, RoleRepository::class);

        $this->app->singleton(IFilmService::class, FilmService::class);
        $this->app->singleton(IFilmRepository::class, FilmRepository::class);

        $this->app->singleton(IGenreService::class, GenreService::class);
        $this->app->singleton(IGenreRepository::class, GenreRepository::class);

        $this->app->singleton(ITaxService::class, TaxService::class);
        $this->app->singleton(ITaxRepository::class, TaxRepository::class);
    }

    public function provides()
    {
        return [
            IUserService::class,
            IUserRepository::class,
            IRoleService::class,
            IRoleRepository::class,
            IFilmService::class,
            IFilmRepository::class,
            IGenreService::class,
            IGenreRepository::class,
            ITaxService::class,
            ITaxRepository::class
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
