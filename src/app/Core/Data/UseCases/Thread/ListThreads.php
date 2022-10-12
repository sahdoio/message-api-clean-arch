<?php

namespace App\Core\Data\UseCases\Thread;

use App\Core\Data\Repositories\Thread\FindThreadRepositoryContract;
use App\Core\Data\Repositories\Thread\FindThreadRepositoryInputDto;
use App\Core\Domain\UseCases\Thread\ListThreadsContract;
use App\Core\Domain\UseCases\Thread\ListThreadsInputDto;
use App\Core\Domain\UseCases\Thread\ListThreadsOutputDto;

class ListThreads implements ListThreadsContract
{
    public function __construct(
        private readonly FindThreadRepositoryContract $findThreadRepository
    ) {
    }

    public function exec(ListThreadsInputDto $data): ListThreadsOutputDto
    {
        $threads = $this->findThreadRepository->findAll(new FindThreadRepositoryInputDto(
            user_id: $data->user_id,
            title: $data->title
        ));

        return new ListThreadsOutputDto($threads);
    }
}
