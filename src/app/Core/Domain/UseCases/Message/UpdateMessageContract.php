<?php

namespace App\Core\Domain\UseCases\Message;

interface UpdateMessageContract
{
    public function exec(int $messageId, UpdateMessageInputDto $inputData): UpdateMessageOutputDto;
}
