<?php

namespace App\Providers;

use App\Services\UserService;
use App\Services\RoleService;
use App\Services\IWashService;
use App\Services\BookingService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\BookingRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService($app->make(UserRepository::class));
        });

        $this->app->singleton(RoleService::class, function ($app) {
            return new RoleService($app->make(RoleRepository::class));
        });

        $this->app->singleton(IWashService::class, function ($app) {
            return new IWashService($app->make(ServiceRepository::class));
        });

        $this->app->singleton(BookingService::class, function ($app) {
            return new BookingService($app->make(BookingRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
