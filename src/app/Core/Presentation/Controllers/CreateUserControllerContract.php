<?php

namespace App\Core\Presentation\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface CreateUserControllerContract
{
    public function handle(Request $request): JsonResponse;
}
