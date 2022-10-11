<?php

namespace App\Core\Data\Repositories\User;

use App\Models\User;
use App\Core\Data\Repositories\User\FindUserRepositoryInputDto;

interface CreateUserRepositoryContract
{
    public function exec(CreateUserRepositoryInputDto $data, bool $asArray = false): null|User;
}
