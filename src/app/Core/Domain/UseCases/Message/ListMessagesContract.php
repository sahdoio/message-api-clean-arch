<?php

namespace App\Core\Domain\UseCases\Message;

interface ListMessagesContract
{
    public function exec(ListMessagesInputDto $inputData): ListMessagesOutputDto;
}
