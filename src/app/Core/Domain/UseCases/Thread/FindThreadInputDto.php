<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\Thread;

use App\Core\Domain\Helpers\BaseDto;

final class FindThreadInputDto extends BaseDto
{
    public function __construct(
        public readonly null|int $id = null,
        public readonly null|string $title = null
    ) {}
}