<?php

namespace App\Core\Presentation\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface BaseControllerContract
{
    public function handle(Request $request): JsonResponse;
}
