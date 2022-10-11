<?php

namespace App\Core\Presentation\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface FindUserControllerContract
{
    public function handle(int $id): JsonResponse;
}
