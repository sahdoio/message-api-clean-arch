<?php

namespace App\Core\Domain\UseCases\Thread;

use App\Core\Domain\UseCases\Thread\FindThreadInputDto;
use App\Core\Domain\UseCases\Thread\FindThreadOutputDto;

interface FindThreadContract
{
    public function exec(FindThreadInputDto $inputData): FindThreadOutputDto;
}
