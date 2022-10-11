<?php

namespace App\Core\Domain\Helpers\Contracts;

interface BaseDtoContract 
{
    public function values(): array;
    public function get(string $property): mixed;
}