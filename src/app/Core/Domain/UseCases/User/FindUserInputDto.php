<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\User;

use App\Core\Domain\Helpers\BaseDto;

final class FindUserInputDto extends BaseDto
{
    public function __construct(
        public readonly null|string $id = null,
        public readonly null|string $email = null
    ) {}
}