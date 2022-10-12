<?php

namespace App\Core\Implementations\Repositories\Message;

use App\Core\Data\Repositories\Message\CreateMessageRepositoryContract;
use App\Core\Data\Repositories\Message\CreateMessageRepositoryInputDto;
use App\Core\Implementations\Repositories\BaseRepository;
use App\Models\Message;

class CreateMessageRepository extends BaseRepository implements CreateMessageRepositoryContract
{
    protected string $modelClass = 'Message';

    public function exec(CreateMessageRepositoryInputDto $data, bool $asArray = false): null|Message
    {
        $model = $this->getModel();
        $entity = $model->create($data->values());
        return $entity ? ($asArray ? $entity->toArray() : $entity) : null;
    }
}
