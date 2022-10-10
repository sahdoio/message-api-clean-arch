<?php

namespace App\Core\Data\UseCases\Authentication;

use App\Core\Data\Repositories\User\FindUserRepositoryContract;
use App\Core\Data\Repositories\User\FindUserRepositoryInputDto;
use App\Core\Domain\UseCases\Authentication\AuthenticationContract;
use App\Core\Domain\UseCases\Authentication\AuthenticationInputDto;
use App\Core\Domain\UseCases\Authentication\AuthenticationOutputDto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Authentication implements AuthenticationContract
{
    public function __construct(
        private readonly FindUserRepositoryContract $findUserRepository
    ) {
    }

    public function exec(AuthenticationInputDto $data): AuthenticationOutputDto
    {
        $user = $this->findUserRepository->findOne(new FindUserRepositoryInputDto(
            email: $data->email
        ));

        if (!$user || !Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($data->email)->plainTextToken;

        $loginUcOutputData = new AuthenticationOutputDto($token, $user);

        return $loginUcOutputData;
    }
}
