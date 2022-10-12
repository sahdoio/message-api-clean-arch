<?php

namespace App\Core\Data\UseCases\Thread;

use App\Core\Data\Repositories\Thread\FindThreadRepositoryContract;
use App\Core\Data\Repositories\Thread\FindThreadRepositoryInputDto;
use App\Core\Domain\UseCases\Thread\FindThreadContract;
use App\Core\Domain\UseCases\Thread\FindThreadInputDto;
use App\Core\Domain\UseCases\Thread\FindThreadOutputDto;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FindThread implements FindThreadContract
{
    public function __construct(
        private readonly FindThreadRepositoryContract $findThreadRepository
    ) {
    }

    public function exec(FindThreadInputDto $data): FindThreadOutputDto
    {
        $thread = $this->findThreadRepository->findOne(new FindThreadRepositoryInputDto(
            title: $data->title
        ));

        if (!$thread) {
            throw new ModelNotFoundException(__('validation.resource_not_found'));
        }

        return new FindThreadOutputDto($thread);
    }
}
