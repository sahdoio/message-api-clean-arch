<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\User;

use App\Core\Domain\Helpers\BaseDto;
use App\Models\User;

final class CreateUserOutputDto extends BaseDto
{
    public function __construct(
        public readonly User $user,
        public readonly string $token
    ) {}
}