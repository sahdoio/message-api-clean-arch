<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\Message;

use App\Core\Domain\Helpers\BaseDto;
use App\Models\Message;

final class ListMessagesOutputDto extends BaseDto
{
    public function __construct(        
        /**
         * @var Message[]
         */
        public readonly array $messages,
    ) {}
}