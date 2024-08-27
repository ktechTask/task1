<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\DayOffTypeRepository;
use App\Repositories\ReppositoryInterface\BaseRepositoryInterface;
use App\Repositories\ReppositoryInterface\DayOffTypeRepositoryInterface;
use App\Repositories\ReppositoryInterface\RequestLeaveRepositoryInterface;
use App\Repositories\ReppositoryInterface\User_DayOffRepositoryInterface;
use App\Repositories\ReppositoryInterface\UserRepositoryInterface;
use App\Repositories\RequestLeaveRepository;
use App\Repositories\User_DayOffRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindingsRepository();    
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $userRepository = app(UserRepositoryInterface::class);
        // dd($userRepository);
    }

    public function bindingsRepository()
    {

       
     $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        
        $this->app->singleton(
            BaseRepositoryInterface::class,
            BaseRepository::class
        );
        $this->app->singleton(
            DayOffTypeRepositoryInterface::class,
            DayOffTypeRepository::class
        );
        $this->app->singleton(
            RequestLeaveRepositoryInterface::class,
            RequestLeaveRepository::class
        );$this->app->singleton(
            User_DayOffRepositoryInterface::class,
            User_DayOffRepository::class
        );
    
    }
}
