<?php

namespace App\Core\Domain\UseCases\Message;

interface CreateMessageContract
{
    public function exec(CreateMessageInputDto $inputData): CreateMessageOutputDto;
}
