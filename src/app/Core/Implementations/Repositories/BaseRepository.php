<?php

namespace App\Core\Implementations\Repositories;

use App\Core\Data\Repositories\BaseRepositoryContract;
use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;


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
}
