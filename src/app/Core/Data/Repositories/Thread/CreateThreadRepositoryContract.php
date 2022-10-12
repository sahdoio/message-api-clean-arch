<?php

namespace App\Core\Data\Repositories\Thread;

use App\Models\Thread;

interface CreateThreadRepositoryContract
{
    public function exec(CreateThreadRepositoryInputDto $data, bool $asArray = false): null|Thread;
}
