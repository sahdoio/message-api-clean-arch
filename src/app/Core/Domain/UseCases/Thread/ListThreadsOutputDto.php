<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\Thread;

use App\Core\Domain\Helpers\BaseDto;
use App\Models\Thread;

final class ListThreadsOutputDto extends BaseDto
{
    public function __construct(        
        /**
         * @var Thread[]
         */
        public readonly array $threads,
    ) {}
}