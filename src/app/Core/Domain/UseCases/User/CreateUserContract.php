<?php

namespace App\Core\Domain\UseCases\User;

interface CreateUserContract
{
    public function exec(CreateUserInputDto $inputData): CreateUserOutputDto;
}
