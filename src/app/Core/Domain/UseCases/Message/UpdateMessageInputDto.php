<?php

declare(strict_types=1);

namespace App\Core\Domain\UseCases\Message;

use App\Core\Domain\Helpers\BaseDto;

final class UpdateMessageInputDto extends BaseDto
{
    public function __construct(
        public readonly string $body
    ) {}
}