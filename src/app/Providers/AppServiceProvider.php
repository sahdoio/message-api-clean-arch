<?php

namespace App\Providers;

use App\Core\Data\Repositories\BaseRepositoryContract;
use App\Core\Data\Repositories\Thread\CreateThreadRepositoryContract;
use App\Core\Data\Repositories\Thread\FindThreadRepositoryContract;
use App\Core\Data\Repositories\User\CreateUserRepositoryContract;
use App\Core\Data\Repositories\User\FindUserRepositoryContract;
use App\Core\Data\UseCases\Authentication\Authentication;
use App\Core\Data\UseCases\User\CreateUser;
use App\Core\Data\UseCases\User\FindUser;
use App\Core\Data\UseCases\Thread\CreateThread;
use App\Core\Data\UseCases\Thread\FindThread;
use App\Core\Domain\UseCases\Authentication\AuthenticationContract;
use App\Core\Domain\UseCases\Thread\CreateThreadContract;
use App\Core\Domain\UseCases\User\CreateUserContract;
use App\Core\Domain\UseCases\User\FindUserContract;
use App\Core\Domain\UseCases\Thread\FindThreadContract;
use App\Core\Implementations\Repositories\BaseRepository;
use App\Core\Implementations\Repositories\Thread\CreateThreadRepository;
use App\Core\Implementations\Repositories\Thread\FindThreadRepository;
use App\Core\Implementations\Repositories\User\CreateUserRepository;
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
        $this->app->bind(CreateUserRepositoryContract::class, CreateUserRepository::class);
        $this->app->bind(FindThreadRepositoryContract::class, FindThreadRepository::class);
        $this->app->bind(CreateThreadRepositoryContract::class, CreateThreadRepository::class);

        // useCases
        $this->app->bind(AuthenticationContract::class, Authentication::class);
        $this->app->bind(CreateUserContract::class, CreateUser::class);
        $this->app->bind(FindUserContract::class, FindUser::class);
        $this->app->bind(CreateThreadContract::class, CreateThread::class);
        $this->app->bind(FindThreadContract::class, FindThread::class);
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
