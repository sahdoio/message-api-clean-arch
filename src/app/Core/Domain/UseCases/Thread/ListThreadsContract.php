<?php

namespace App\Core\Domain\UseCases\Thread;

interface ListThreadsContract
{
    public function exec(ListThreadsInputDto $inputData): ListThreadsOutputDto;
}
