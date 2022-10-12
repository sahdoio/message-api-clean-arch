<?php

namespace App\Core\Presentation\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface ListMessagesControllerContract
{
    public function handle(Request $request, int|string $threadId): JsonResponse;
}
