<?php

namespace App\Core\Implementations\Repositories\User;

use App\Models\User;
use App\Core\Data\Repositories\User\FindUserRepositoryContract;
use App\Core\Data\Repositories\User\FindUserRepositoryInputDto;
use App\Core\Implementations\Repositories\BaseRepository;

class FindUserRepository extends BaseRepository implements FindUserRepositoryContract
{
    protected string $modelClass = 'User';

    private function setFilters(FindUserRepositoryInputDto $data): void
    {
        if ($data->id) {
            $this->queryBuilder->where('id', $data->id);
        }

        if ($data->email) {
            $this->queryBuilder->where('email', $data->email);
        }
    }

    public function findOne(FindUserRepositoryInputDto $data): null|User
    {
        $this->setFilters($data);
        return $this->queryBuilder->first();
    }

    public function findAll(FindUserRepositoryInputDto $data): null|array
    {
        $this->setFilters($data);
        return $this->queryBuilder->get()->asArray();
    }
}
