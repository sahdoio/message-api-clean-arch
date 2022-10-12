<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Core\Presentation\Helpers\APIResponse;
use Illuminate\Http\JsonResponse;

class StatusController extends Controller
{
    /**
     * Check whether api is alive or not
     *
     * @return JsonResponse 
     */
    public function apiAlive(): JsonResponse
    {    
        return APIResponse::success('api alive', [
            'version' => env('APP_VERSION', 'development')
        ]);
    }
}