<?php

namespace App\Providers;

use App\Repository\Eloquent\BaseRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\UserService\UserRepository;
use App\Repository\UserService\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
	    $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
	    $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
