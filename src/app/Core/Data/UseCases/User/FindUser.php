<?php

namespace App\Core\Data\UseCases\User;

use App\Core\Data\Repositories\User\FindUserRepositoryContract;
use App\Core\Data\Repositories\User\FindUserRepositoryInputDto;
use App\Core\Domain\UseCases\User\FindUserInputDto;
use App\Core\Domain\UseCases\User\FindUserContract;
use App\Core\Domain\UseCases\User\FindUserOutputDto;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FindUser implements FindUserContract
{
    public function __construct(
        private readonly FindUserRepositoryContract $findUserRepository
    ) {
    }

    public function exec(FindUserInputDto $data): FindUserOutputDto
    {
        $user = $this->findUserRepository->findOne(new FindUserRepositoryInputDto(
            id: $data->id,
            email: $data->email
        ));

        if (!$user) {
            throw new ModelNotFoundException(__('validation.resource_not_found'));
        }

        return new FindUserOutputDto($user);
    }
}
