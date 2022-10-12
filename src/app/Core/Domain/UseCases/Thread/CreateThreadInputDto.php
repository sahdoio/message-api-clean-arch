<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\Thread;

use App\Core\Domain\Helpers\BaseDto;

final class CreateThreadInputDto extends BaseDto
{
    public function __construct(
        public readonly string $title
    ) {}
}