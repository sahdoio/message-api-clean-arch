<?php

namespace Core\Data\Helpers;

class QueryCriteria
{
    private int $limit;
    private string $columns;
    private string $sortType;
    private string $sortColumn;
    private int $offset;
    private string $type;

    public function __construct(
        int $limit = 5,
        string $sortType = 'asc',
        string $sortColumn = 'id'
    ) {
        $this->limit = $limit < 0 ? 20 : $limit;
        $this->columns = '*';
        $this->sortType = $sortType;
        $this->sortColumn = $sortColumn;
        $this->offset = 1;
        $this->type = 'page';
    }

    public function getLimit(): string
    {
        return $this->limit;
    }

    public function getColumns(): string
    {
        return $this->columns;
    }

    public function getSortType(): string
    {
        return $this->sortType;
    }

    public function getSortColumn(): string
    {
        return $this->sortColumn;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
