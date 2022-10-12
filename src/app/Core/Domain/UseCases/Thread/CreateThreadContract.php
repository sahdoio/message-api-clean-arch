<?php

namespace App\Core\Domain\UseCases\Thread;

interface CreateThreadContract
{
    public function exec(CreateThreadInputDto $inputData): CreateThreadOutputDto;
}
