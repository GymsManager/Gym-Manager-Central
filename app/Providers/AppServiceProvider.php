<?php

namespace App\Providers;

use App\Repositories\Eloquent\BranchRepository;
use App\Repositories\Eloquent\CityRepository;
use App\Repositories\Eloquent\GymRepository;
use App\Repositories\Eloquent\SubscriptionPlanRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\BranchRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\GymRepositoryInterface;
use App\Repositories\Interfaces\SubscriptionPlanRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GymRepositoryInterface::class, GymRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SubscriptionPlanRepositoryInterface::class, SubscriptionPlanRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(BranchRepositoryInterface::class,BranchRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
