<?php

namespace App\Core\Domain\UseCases\Message;

use App\Core\Domain\Helpers\UcOptions;

interface ListMessagesContract
{
    public function exec(ListMessagesInputDto $inputData, UcOptions $ucOptions): ListMessagesOutputDto;
}
