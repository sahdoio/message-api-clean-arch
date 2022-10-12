<?php

namespace App\Core\Presentation\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface ListThreadsControllerContract
{
    public function handle(Request $request, int|string $userId): JsonResponse;
}
