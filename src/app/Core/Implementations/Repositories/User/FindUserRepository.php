<?php

namespace App\Core\Implementations\Repositories\User;

use App\Models\User;
use App\Core\Data\Repositories\User\FindUserRepositoryContract;
use App\Core\Data\Repositories\User\FindUserRepositoryInputDto;
use App\Core\Implementations\Repositories\BaseRepository;

class FindUserRepository extends BaseRepository implements FindUserRepositoryContract
{
    protected string $modelClass = 'User';

    public function findOne(FindUserRepositoryInputDto $data): null|User
    {
        if ($data->id) {
            $this->queryBuilder->where('id', $data->id);
        }

        if ($data->email) {
            $this->queryBuilder->where('email', $data->email);
        }

        return $this->queryBuilder->first();
    }
}
