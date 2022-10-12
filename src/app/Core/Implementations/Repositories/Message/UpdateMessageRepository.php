<?php

namespace App\Core\Implementations\Repositories\Message;

use App\Core\Data\Repositories\Message\UpdateMessageRepositoryContract;
use App\Core\Data\Repositories\Message\UpdateMessageRepositoryInputDto;
use App\Core\Implementations\Repositories\BaseRepository;
use App\Models\Message;

class UpdateMessageRepository extends BaseRepository implements UpdateMessageRepositoryContract
{
    protected string $modelClass = 'Message';

    public function exec(int $messageId, UpdateMessageRepositoryInputDto $data, bool $asArray = false): null|Message
    {
        $entity = $this->queryBuilder->firstWhere('id', $messageId);
        foreach($data as $fieldKey => $field) {
            $entity->{$fieldKey} = $field; 
        }
        $entity->save();
        return $entity;
    }
}
