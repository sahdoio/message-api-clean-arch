<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\Authentication;

use App\Core\Domain\Helpers\BaseDto;
use App\Models\User;

final class AuthenticationOutputDto extends BaseDto
{
    public function __construct(
        public string $token,
        public readonly User $user
    ) {}
}