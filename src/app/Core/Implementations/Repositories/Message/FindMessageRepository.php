<?php

namespace App\Core\Implementations\Repositories\Message;

use App\Core\Data\Repositories\Message\FindMessageRepositoryContract;
use App\Core\Data\Repositories\Message\FindMessageRepositoryInputDto;
use App\Core\Domain\Helpers\UcOptions;
use App\Core\Implementations\Repositories\BaseRepository;
use App\Models\Message;

class FindMessageRepository extends BaseRepository implements FindMessageRepositoryContract
{
    protected string $modelClass = 'Message';

    private function setFilters(FindMessageRepositoryInputDto $data): void
    {
        if ($data->id) {
            $this->queryBuilder->where('id', $data->id);
        }

        if ($data->user_id) {
            $this->queryBuilder->where('user_id', $data->user_id);
        }

        if ($data->thread_id) {
            $this->queryBuilder->where('thread_id', $data->thread_id);
        }

        if ($data->body) {
            $this->queryBuilder->where('body', 'like', '%' . $data->body . '%');
        }
    }

    public function findOne(FindMessageRepositoryInputDto $data): null|Message
    {
        $this->setFilters($data);
        return $this->queryBuilder->first();
    }

    public function findAll(FindMessageRepositoryInputDto $data, UcOptions $ucOptions): null|array
    {
        $this->setFilters($data);
        return $this->doQuery($ucOptions)->toArray();
    }
}
