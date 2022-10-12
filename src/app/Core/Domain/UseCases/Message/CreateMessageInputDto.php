<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\Message;

use App\Core\Domain\Helpers\BaseDto;

final class CreateMessageInputDto extends BaseDto
{
    public function __construct(
        public readonly int $user_id,
        public readonly int $thread_id,
        public readonly string $body
    ) {}
}