<?php

namespace App\Core\Implementations\Repositories\Thread;

use App\Core\Data\Repositories\Thread\CreateThreadRepositoryContract;
use App\Core\Data\Repositories\Thread\CreateThreadRepositoryInputDto;
use App\Models\Thread;
use App\Core\Implementations\Repositories\BaseRepository;

class CreateThreadRepository extends BaseRepository implements CreateThreadRepositoryContract
{
    protected string $modelClass = 'Thread';

    public function exec(CreateThreadRepositoryInputDto $data, bool $asArray = false): null|Thread
    {
        $model = $this->getModel();
        $entity = $model->create($data->values());
        return $entity ? ($asArray ? $entity->toArray() : $entity) : null;
    }
}
