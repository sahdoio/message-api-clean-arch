<?php

declare(strict_types=1);

namespace App\Core\Data\Repositories\User;

use App\Core\Domain\Helpers\BaseDto;
use Carbon\Carbon;
use DateTime;

final class CreateUserRepositoryInputDto extends BaseDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $full_name,
        public readonly string $password,
        public readonly null|string $bio = null
    ) {}
}