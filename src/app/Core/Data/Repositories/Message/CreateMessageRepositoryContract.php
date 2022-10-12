<?php

namespace App\Core\Data\Repositories\Message;

use App\Models\Message;

interface CreateMessageRepositoryContract
{
    public function exec(CreateMessageRepositoryInputDto $data, bool $asArray = false): null|Message;
}
