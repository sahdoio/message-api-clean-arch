<?php

namespace App\Providers;

use App\Core\Data\Repositories\BaseRepositoryContract;
use App\Core\Data\Repositories\Message\CreateMessageRepositoryContract;
use App\Core\Data\Repositories\Message\FindMessageRepositoryContract;
use App\Core\Data\Repositories\Message\UpdateMessageRepositoryContract;
use App\Core\Data\Repositories\Thread\CreateThreadRepositoryContract;
use App\Core\Data\Repositories\Thread\FindThreadRepositoryContract;
use App\Core\Data\Repositories\User\CreateUserRepositoryContract;
use App\Core\Data\Repositories\User\FindUserRepositoryContract;
use App\Core\Data\UseCases\Authentication\Authentication;
use App\Core\Data\UseCases\Message\CreateMessage;
use App\Core\Data\UseCases\Message\ListMessages;
use App\Core\Data\UseCases\Message\UpdateMessage;
use App\Core\Data\UseCases\User\CreateUser;
use App\Core\Data\UseCases\User\FindUser;
use App\Core\Data\UseCases\Thread\CreateThread;
use App\Core\Data\UseCases\Thread\FindThread;
use App\Core\Data\UseCases\Thread\ListThreads;
use App\Core\Domain\UseCases\Authentication\AuthenticationContract;
use App\Core\Domain\UseCases\Message\CreateMessageContract;
use App\Core\Domain\UseCases\Message\ListMessagesContract;
use App\Core\Domain\UseCases\Message\UpdateMessageContract;
use App\Core\Domain\UseCases\Thread\CreateThreadContract;
use App\Core\Domain\UseCases\User\CreateUserContract;
use App\Core\Domain\UseCases\User\FindUserContract;
use App\Core\Domain\UseCases\Thread\FindThreadContract;
use App\Core\Domain\UseCases\Thread\ListThreadsContract;
use App\Core\Implementations\Repositories\BaseRepository;
use App\Core\Implementations\Repositories\Message\CreateMessageRepository;
use App\Core\Implementations\Repositories\Message\FindMessageRepository;
use App\Core\Implementations\Repositories\Message\UpdateMessageRepository;
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
        $this->app->bind(CreateMessageRepositoryContract::class, CreateMessageRepository::class);
        $this->app->bind(FindMessageRepositoryContract::class, FindMessageRepository::class);
        $this->app->bind(UpdateMessageRepositoryContract::class, UpdateMessageRepository::class);

        // useCases
        $this->app->bind(AuthenticationContract::class, Authentication::class);
        $this->app->bind(CreateUserContract::class, CreateUser::class);
        $this->app->bind(FindUserContract::class, FindUser::class);
        $this->app->bind(CreateThreadContract::class, CreateThread::class);
        $this->app->bind(FindThreadContract::class, FindThread::class);
        $this->app->bind(ListThreadsContract::class, ListThreads::class);
        $this->app->bind(CreateMessageContract::class, CreateMessage::class);
        $this->app->bind(ListMessagesContract::class, ListMessages::class);
        $this->app->bind(UpdateMessageContract::class, UpdateMessage::class);
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
