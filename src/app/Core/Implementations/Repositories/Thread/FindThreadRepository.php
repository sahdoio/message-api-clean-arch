<?php

namespace App\Core\Implementations\Repositories\Thread;

use App\Core\Data\Repositories\Thread\FindThreadRepositoryContract;
use App\Core\Data\Repositories\Thread\FindThreadRepositoryInputDto;
use App\Models\Thread;
use App\Core\Implementations\Repositories\BaseRepository;

class FindThreadRepository extends BaseRepository implements FindThreadRepositoryContract
{
    protected string $modelClass = 'Thread';

    public function findOne(FindThreadRepositoryInputDto $data): null|Thread
    {
        if ($data->id) {
            $this->queryBuilder->where('id', $data->id);
        }

        if ($data->title) {
            $this->queryBuilder->where('title', $data->title);
        }

        return $this->queryBuilder->first();
    }
}
