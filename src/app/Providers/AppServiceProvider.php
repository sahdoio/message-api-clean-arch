<?php

namespace App\Providers;

use App\Core\Data\Repositories\BaseRepositoryContract;
use App\Core\Data\Repositories\User\FindUserRepositoryContract;
use App\Core\Data\UseCases\Authentication\Authentication;
use App\Core\Domain\UseCases\Authentication\AuthenticationContract;
use App\Core\Implementations\Repositories\BaseRepository;
use App\Core\Implementations\Repositories\User\FindUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // repositories
        $this->app->bind(BaseRepositoryContract::class, BaseRepository::class);
        $this->app->bind(FindUserRepositoryContract::class, FindUserRepository::class);
        
        // useCases
        $this->app->bind(AuthenticationContract::class, Authentication::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
