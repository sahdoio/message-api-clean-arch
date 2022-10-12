<?php

namespace App\Core\Presentation\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface CreateMessageControllerContract
{
    public function handle(Request $request): JsonResponse;
}
