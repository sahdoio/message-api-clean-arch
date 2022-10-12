<?php

declare(strict_types=1);

namespace App\Core\Data\Repositories\Message;

use App\Core\Domain\Helpers\BaseDto;

final class UpdateMessageRepositoryInputDto extends BaseDto
{
    public function __construct(
        public readonly string $body,
    ) {}
}