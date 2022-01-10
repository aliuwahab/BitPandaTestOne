<?php

namespace App\Providers;

use BitPanda\UserProfile\Eloquent\UserProfileRepository;
use BitPanda\UserProfile\UserProfileRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register repository service provider services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserProfileRepositoryInterface::class, UserProfileRepository::class);
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
