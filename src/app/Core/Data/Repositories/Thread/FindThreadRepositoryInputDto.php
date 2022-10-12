<?php

declare(strict_types=1);

namespace App\Core\Data\Repositories\Thread;

use App\Core\Domain\Helpers\BaseDto;

final class FindThreadRepositoryInputDto extends BaseDto
{
    public function __construct(
        public readonly null|int $user_id = null,
        public readonly null|int $id = null,
        public readonly null|string $title = null
    ) {}
}