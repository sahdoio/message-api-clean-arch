<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\Thread;

use App\Core\Domain\Helpers\BaseDto;
use App\Models\Thread;

final class FindThreadOutputDto extends BaseDto
{
    public function __construct(
        public readonly Thread $thread,
    ) {}
}