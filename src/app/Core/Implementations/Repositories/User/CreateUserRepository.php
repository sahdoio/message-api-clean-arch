<?php

namespace App\Core\Implementations\Repositories\User;

use App\Core\Data\Repositories\User\CreateUserRepositoryContract;
use App\Core\Data\Repositories\User\CreateUserRepositoryInputDto;
use App\Models\User;
use App\Core\Implementations\Repositories\BaseRepository;

class CreateUserRepository extends BaseRepository implements CreateUserRepositoryContract
{
    protected string $modelClass = 'User';

    public function exec(CreateUserRepositoryInputDto $data, bool $asArray = false): null|User
    {
        $model = $this->getModel();
        $entity = $model->create($data->values());
        return $entity ? ($asArray ? $entity->toArray() : $entity) : null;
    }
}
