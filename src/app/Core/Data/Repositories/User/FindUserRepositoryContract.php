<?php

namespace App\Core\Data\Repositories\User;

use App\Models\User;
use App\Core\Data\Repositories\User\FindUserRepositoryInputDto;

interface FindUserRepositoryContract
{
    public function findOne(FindUserRepositoryInputDto $data): null|User;
}
