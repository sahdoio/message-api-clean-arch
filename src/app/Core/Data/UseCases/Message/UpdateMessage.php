<?php

namespace App\Core\Data\UseCases\Message;

use App\Core\Data\Repositories\Message\UpdateMessageRepositoryContract;
use App\Core\Data\Repositories\Message\UpdateMessageRepositoryInputDto;
use App\Core\Data\Repositories\Message\FindMessageRepositoryContract;
use App\Core\Data\Repositories\Message\FindMessageRepositoryInputDto;
use App\Core\Data\Repositories\Thread\FindThreadRepositoryContract;
use App\Core\Data\Repositories\User\FindUserRepositoryContract;
use App\Core\Domain\UseCases\Message\UpdateMessageInputDto;
use App\Core\Domain\UseCases\Message\UpdateMessageOutputDto;
use App\Core\Domain\UseCases\Message\UpdateMessageContract;
use App\Models\Message;
use Illuminate\Validation\ValidationException;

class UpdateMessage implements UpdateMessageContract
{
    public function __construct(
        private readonly UpdateMessageRepositoryContract $updateMessageRepository,
        private readonly FindMessageRepositoryContract $findMessageRepository,
        private readonly FindUserRepositoryContract $findUserRepository,
        private readonly FindThreadRepositoryContract $findThreadRepositoryContract,
    ) {
    }

    public function exec(int $messageId, UpdateMessageInputDto $data): UpdateMessageOutputDto
    {
        $message = $this->findMessageRepository->findOne(new FindMessageRepositoryInputDto(
            id: $messageId
        ));

        if (!$message) {
            throw ValidationException::withMessages([
                __('validation.resource_not_found'),
            ]);
        }

        if (!$this->verifyEditTime($message)) {
            throw ValidationException::withMessages([
                __('updateMessage.edit_time_limit_error')
            ]);
        }

        $message = $this->updateMessageRepository->exec($messageId, new UpdateMessageRepositoryInputDto(
            body: $data->body
        ));

        return new UpdateMessageOutputDto($message);
    }

    private function verifyEditTime(Message $message): bool
    {
        if ($message->created_at->addMinutes(5)->isPast()) {
            return false;
        }

        return true;
    }
}
