<?php

namespace App\Core\Data\Repositories\Message;

use App\Core\Domain\Helpers\UcOptions;
use App\Models\Message;

interface FindMessageRepositoryContract
{
    public function findOne(FindMessageRepositoryInputDto $data): null|Message;
    public function findAll(FindMessageRepositoryInputDto $data, UcOptions $ucOptions): null|array;
}
