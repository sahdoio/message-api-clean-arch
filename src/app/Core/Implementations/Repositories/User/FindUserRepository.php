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
        if ($data->email) {
            $this->queryBuilder->where('email', $data->email);
        }

        if ($data->username) {
            $this->queryBuilder->where('username', $data->username);
        }  

        return $this->queryBuilder->first();
    }
}
