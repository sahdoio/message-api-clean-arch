<?php

declare(strict_types=1);

namespace App\Core\Data\Repositories\User;

use App\Core\Domain\Helpers\BaseDto;

final class FindUserRepositoryInputDto extends BaseDto
{
    public function __construct(
        public readonly null|int $id = null,
        public readonly null|string $email = null
    ) {}
}