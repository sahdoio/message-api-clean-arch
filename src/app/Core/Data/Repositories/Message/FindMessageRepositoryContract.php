<?php

namespace App\Core\Data\Repositories\Message;

use App\Models\Message;

interface FindMessageRepositoryContract
{
    public function findOne(FindMessageRepositoryInputDto $data): null|Message;
    public function findAll(FindMessageRepositoryInputDto $data): null|array;
}
