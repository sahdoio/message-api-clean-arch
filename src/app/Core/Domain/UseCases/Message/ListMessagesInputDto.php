<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\Message;

use App\Core\Domain\Helpers\BaseDto;

final class ListMessagesInputDto extends BaseDto
{
    public function __construct(
        public readonly null|int $thread_id = null,
        public readonly null|int $user_id = null,
        public readonly null|string $body = null
    ) {}
}