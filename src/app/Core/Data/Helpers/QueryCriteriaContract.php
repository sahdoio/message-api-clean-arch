<?php

namespace Core\Data\Helpers;

interface QueryCriteriaContract
{
    public function getLimit(): string;

    public function getColumns(): string;

    public function getSortType(): string;

    public function getSortColumn(): string;

    public function getOffset(): int;
    
    public function getType(): string;
}
