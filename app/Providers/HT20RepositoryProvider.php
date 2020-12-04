<?php

namespace App\Providers;

use App\Repositories\HT20\ApartmentRepository;
use App\Repositories\HT20\UserRepository;
use App\Repositories\Impl\HT20\ApartmentRepositoryImpl;
use App\Repositories\Impl\HT20\UserRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class HT20RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            ApartmentRepository::class,
            ApartmentRepositoryImpl::class
        );
        $this->app->singleton(
            UserRepository::class,
            UserRepositoryImpl::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
