<?php

namespace App\Core\Data\Repositories;

use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

interface BaseRepositoryContract
{
    public function getQueryBuilder(): EloquentQueryBuilder|QueryBuilder;
}
