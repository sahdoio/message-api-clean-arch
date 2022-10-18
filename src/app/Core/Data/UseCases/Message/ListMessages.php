<?php

namespace App\Core\Data\UseCases\Message;

use App\Core\Data\Repositories\Message\FindMessageRepositoryContract;
use App\Core\Data\Repositories\Message\FindMessageRepositoryInputDto;
use App\Core\Domain\Helpers\UcOptions;
use App\Core\Domain\UseCases\Message\ListMessagesContract;
use App\Core\Domain\UseCases\Message\ListMessagesInputDto;
use App\Core\Domain\UseCases\Message\ListMessagesOutputDto;

class ListMessages implements ListMessagesContract
{
    public function __construct(
        private readonly FindMessageRepositoryContract $findMessageRepository
    ) {}

    public function exec(ListMessagesInputDto $data, UcOptions $ucOptions): ListMessagesOutputDto
    {
        $messages = $this->findMessageRepository->findAll(new FindMessageRepositoryInputDto(
            user_id: $data->user_id,
            thread_id: $data->thread_id,
            body: $data->body
        ), $ucOptions);

        return new ListMessagesOutputDto($messages);
    }
}
