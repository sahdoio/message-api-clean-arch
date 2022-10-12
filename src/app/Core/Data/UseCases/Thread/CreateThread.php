<?php

namespace App\Core\Data\UseCases\Thread;

use App\Core\Data\Repositories\Thread\CreateThreadRepositoryContract;
use App\Core\Data\Repositories\Thread\CreateThreadRepositoryInputDto;
use App\Core\Data\Repositories\Thread\FindThreadRepositoryContract;
use App\Core\Data\Repositories\Thread\FindThreadRepositoryInputDto;
use App\Core\Domain\UseCases\Thread\CreateThreadContract;
use App\Core\Domain\UseCases\Thread\CreateThreadInputDto;
use App\Core\Domain\UseCases\Thread\CreateThreadOutputDto;
use Illuminate\Validation\ValidationException;

class CreateThread implements CreateThreadContract
{
    public function __construct(
        private readonly CreateThreadRepositoryContract $createThreadRepository,
        private readonly FindThreadRepositoryContract $findThreadRepository
    ) {
    }

    public function exec(CreateThreadInputDto $data): CreateThreadOutputDto
    {
        $thread = $this->findThreadRepository->findOne(new FindThreadRepositoryInputDto(
            title: $data->title
        ));

        if ($thread) {
            throw ValidationException::withMessages([
                __('validation.duplicated_resource')
            ]);
        }

        $thread = $this->createThreadRepository->exec(new CreateThreadRepositoryInputDto(
            title: $data->title
        ));

        return new CreateThreadOutputDto($thread);
    }
}
