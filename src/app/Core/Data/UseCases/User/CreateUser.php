<?php

namespace App\Core\Data\UseCases\User;

use App\Core\Data\Repositories\User\CreateUserRepositoryContract;
use App\Core\Data\Repositories\User\CreateUserRepositoryInputDto;
use App\Core\Data\Repositories\User\FindUserRepositoryContract;
use App\Core\Data\Repositories\User\FindUserRepositoryInputDto;
use App\Core\Domain\UseCases\User\CreateUserContract;
use App\Core\Domain\UseCases\User\CreateUserInputDto;
use App\Core\Domain\UseCases\User\CreateUserOutputDto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CreateUser implements CreateUserContract
{
    public function __construct(
        private readonly CreateUserRepositoryContract $createUserRepository,
        private readonly FindUserRepositoryContract $findUserRepository
    ) {
    }

    public function exec(CreateUserInputDto $data): CreateUserOutputDto
    {
        $user = $this->findUserRepository->findOne(new FindUserRepositoryInputDto(
            email: $data->email
        ));

        if ($user) {
            throw ValidationException::withMessages([
                __('validation.duplicated_resource')
            ]);
        }

        $user = $this->createUserRepository->exec(new CreateUserRepositoryInputDto(
            email: $data->email,
            full_name: $data->full_name,
            bio: $data->bio,
            password: Hash::make($data->password)
        ));

        $token = $user->createToken($user->email)->plainTextToken;

        return new CreateUserOutputDto($user, $token);
    }
}
