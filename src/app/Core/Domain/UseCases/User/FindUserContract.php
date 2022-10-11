<?php

namespace App\Core\Domain\UseCases\User;

use App\Core\Domain\UseCases\User\FindUserInputDto;

interface FindUserContract
{
    public function exec(FindUserInputDto $inputData): FindUserOutputDto;
}
