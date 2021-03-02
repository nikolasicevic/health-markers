<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\DayRepositoryInterface;
use App\Repositories\DayRepository;
use App\Interfaces\SleepSessionRepositoryInterface;
use App\Repositories\SleepSessionRepository;
use App\Interfaces\MealRepositoryInterface;
use App\Repositories\MealRepository;
use App\Interfaces\ActivitySessionRepositoryInterface;
use App\Repositories\ActivitySessionRepository;
use App\Interfaces\ActivityRepositoryInterface;
use App\Repositories\ActivityRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DayRepositoryInterface::class, DayRepository::class);
        $this->app->bind(SleepSessionRepositoryInterface::class, SleepSessionRepository::class);
        $this->app->bind(MealRepositoryInterface::class, MealRepository::class);
        $this->app->bind(ActivitySessionRepositoryInterface::class, ActivitySessionRepository::class);
        $this->app->bind(ActivityRepositoryInterface::class, ActivityRepository::class);
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
