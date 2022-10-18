<?php

namespace App\Core\Implementations\Repositories;

use App\Core\Data\Repositories\BaseRepositoryContract;
use App\Core\Domain\Helpers\UcOptions;
use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\AbstractPaginator as Paginator;

class BaseRepository implements BaseRepositoryContract
{
    protected EloquentQueryBuilder|QueryBuilder $queryBuilder;
    protected string $modelClass;

    public function __construct()
    {
        $this->queryBuilder = $this->getQueryBuilder();
    }

    public function getQueryBuilder(): EloquentQueryBuilder|QueryBuilder
    {
        $this->modelClass = "App\Models\\$this->modelClass";
        return app($this->modelClass)->newQuery();
    }

    public function getModel(): Model
    {
        return app($this->modelClass);
    }

    public function doQuery(UcOptions|null $ucOptions = null): EloquentCollection|Paginator
    {
        if ($ucOptions->page && $ucOptions->limit) {
            return $this->queryBuilder->paginate($ucOptions->limit);
        }

        if ($ucOptions->limit > 0) {
            $this->queryBuilder->take($ucOptions->limit);
        }

        return $this->queryBuilder->get();
    }
}
