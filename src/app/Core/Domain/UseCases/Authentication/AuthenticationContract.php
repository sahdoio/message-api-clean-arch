<?php

namespace App\Core\Domain\UseCases\Authentication;

interface AuthenticationContract
{
    public function exec(AuthenticationInputDto $inputData): AuthenticationOutputDto;
}
