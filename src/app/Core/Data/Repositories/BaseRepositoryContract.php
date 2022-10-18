<?php

namespace App\Core\Data\Repositories;

use App\Core\Domain\Helpers\UcOptions;
use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractPaginator as Paginator;

interface BaseRepositoryContract
{
    public function getQueryBuilder(): EloquentQueryBuilder|QueryBuilder;
    public function getModel(): Model;
    public function doQuery(UcOptions $ucOptions): EloquentCollection|Paginator;
}
