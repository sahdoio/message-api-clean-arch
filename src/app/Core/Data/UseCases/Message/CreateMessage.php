<?php

namespace App\Core\Data\UseCases\Message;

use App\Core\Data\Repositories\Message\CreateMessageRepositoryContract;
use App\Core\Data\Repositories\Message\CreateMessageRepositoryInputDto;
use App\Core\Data\Repositories\Message\FindMessageRepositoryContract;
use App\Core\Data\Repositories\Thread\FindThreadRepositoryContract;
use App\Core\Data\Repositories\Thread\FindThreadRepositoryInputDto;
use App\Core\Data\Repositories\User\FindUserRepositoryContract;
use App\Core\Data\Repositories\User\FindUserRepositoryInputDto;
use App\Core\Domain\UseCases\Message\CreateMessageContract;
use App\Core\Domain\UseCases\Message\CreateMessageInputDto;
use App\Core\Domain\UseCases\Message\CreateMessageOutputDto;
use Illuminate\Validation\ValidationException;

class CreateMessage implements CreateMessageContract
{
    public function __construct(
        private readonly CreateMessageRepositoryContract $createMessageRepository,
        private readonly FindMessageRepositoryContract $findMessageRepository,
        private readonly FindUserRepositoryContract $findUserRepository,
        private readonly FindThreadRepositoryContract $findThreadRepositoryContract,
    ) {
    }

    public function exec(CreateMessageInputDto $data): CreateMessageOutputDto
    {
        $user = $this->findUserRepository->findOne(new FindUserRepositoryInputDto(
            id: $data->user_id
        ));

        $thread = $this->findThreadRepositoryContract->findOne(new FindThreadRepositoryInputDto(
            id: $data->thread_id
        ));

        if (!$user || !$thread) {
            throw ValidationException::withMessages([
                __('validation.resource_not_found')
            ]);
        }

        $message = $this->createMessageRepository->exec(new CreateMessageRepositoryInputDto(
            user_id: $data->user_id,
            thread_id: $data->thread_id,
            body: $data->body
        ));

        return new CreateMessageOutputDto($message);
    }
}
