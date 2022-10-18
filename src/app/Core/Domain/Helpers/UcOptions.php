<?php

namespace App\Core\Domain\Helpers;

class UcOptions
{
    public function __construct(
        public readonly int $limit = 15,
        public readonly int $page = 1
    ) {}
}
