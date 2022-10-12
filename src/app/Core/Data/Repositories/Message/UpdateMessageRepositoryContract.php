<?php

namespace App\Core\Data\Repositories\Message;

use App\Models\Message;

interface UpdateMessageRepositoryContract
{
    public function exec(int $messageId, UpdateMessageRepositoryInputDto $data, bool $asArray = false): null|Message;
}
