<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\Message;

use App\Core\Domain\Helpers\BaseDto;
use App\Models\Message;

final class UpdateMessageOutputDto extends BaseDto
{
    public function __construct(
        public readonly Message $message,
    ) {}
}