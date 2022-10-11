<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\User;

use App\Core\Domain\Helpers\BaseDto;

final class CreateUserInputDto extends BaseDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $full_name,
        public readonly string $password,
        public readonly string $bio
    ) {}
}