<?php

namespace App\Providers\Repositories;

use Illuminate\Support\ServiceProvider;

class TeamServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        app()->bind(
            \App\Repositories\Team\Interfaces\TeamDataAccessRepositoryInterface::class,
            \App\Repositories\Team\Repositories\TeamDataAccessRepository::class
        );
        app()->bind(
            \App\Repositories\Team\Interfaces\TeamDataSaveRepositoryInterface::class,
            \App\Repositories\Team\Repositories\TeamDataSaveRepository::class
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
