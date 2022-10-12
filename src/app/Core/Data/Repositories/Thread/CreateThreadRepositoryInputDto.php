<?php

declare(strict_types=1);

namespace App\Core\Data\Repositories\Thread;

use App\Core\Domain\Helpers\BaseDto;

final class CreateThreadRepositoryInputDto extends BaseDto
{
    public function __construct(
        public readonly string $title,
    ) {}
}