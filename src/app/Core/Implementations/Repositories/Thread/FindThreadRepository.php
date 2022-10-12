<?php

namespace App\Core\Implementations\Repositories\Thread;

use App\Core\Data\Repositories\Thread\FindThreadRepositoryContract;
use App\Core\Data\Repositories\Thread\FindThreadRepositoryInputDto;
use App\Models\Thread;
use App\Core\Implementations\Repositories\BaseRepository;

class FindThreadRepository extends BaseRepository implements FindThreadRepositoryContract
{
    protected string $modelClass = 'Thread';

    private function setFilters(FindThreadRepositoryInputDto $data): void
    {      
        if ($data->user_id) {
            $this->queryBuilder->select('threads.*');
            $this->queryBuilder->join('messages', 'messages.thread_id', '=', 'threads.id');
            $this->queryBuilder->where('messages.user_id', $data->user_id);
        }

        if ($data->id) {
            $this->queryBuilder->where('id', $data->id);
        }

        if ($data->title) {
            $this->queryBuilder->where('title', 'like', '%' . $data->title . '%');
        }
    }

    public function findOne(FindThreadRepositoryInputDto $data): null|Thread
    {
        $this->setFilters($data);
        return $this->queryBuilder->first();
    }

    public function findAll(FindThreadRepositoryInputDto $data): null|array
    {
        $this->setFilters($data);
        return $this->queryBuilder->get()->toArray();
    }
}
