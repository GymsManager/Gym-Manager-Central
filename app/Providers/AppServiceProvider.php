<?php

namespace App\Providers;

<<<<<<< HEAD
use App\Repositories\Eloquent\BranchRepository;
use App\Repositories\Eloquent\CityRepository;
=======
use App\Repositories\Eloquent\ActionRepository;
use App\Repositories\Eloquent\BranchRepository;
use App\Repositories\Eloquent\CityRepository;
use App\Repositories\Eloquent\FeatureRepository;
>>>>>>> 51bd07d (Gym-review)
use App\Repositories\Eloquent\GymRepository;
use App\Repositories\Eloquent\SubscriptionPlanRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
<<<<<<< HEAD
use App\Repositories\Interfaces\BranchRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
=======
use App\Repositories\Interfaces\ActionRepositoryInterface;
use App\Repositories\Interfaces\BranchRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\FeatureRepositoryInterface;
>>>>>>> 51bd07d (Gym-review)
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
<<<<<<< HEAD
=======
        $this->app->bind(ActionRepositoryInterface::class, ActionRepository::class);
        $this->app->bind(FeatureRepositoryInterface::class, FeatureRepository::class);
>>>>>>> 51bd07d (Gym-review)
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
