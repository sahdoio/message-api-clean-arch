<?php

declare(strict_types=1);

namespace App\Core\Data\Repositories\Message;

use App\Core\Domain\Helpers\BaseDto;

final class CreateMessageRepositoryInputDto extends BaseDto
{
    public function __construct(
        public readonly int $user_id,
        public readonly int $thread_id,
        public readonly string $body,
    ) {}
}