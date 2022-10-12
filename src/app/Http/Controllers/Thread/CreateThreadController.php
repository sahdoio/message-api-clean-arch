<?php

namespace App\Http\Controllers\Thread;

use App\Http\Controllers\Controller;
use App\Core\Common\Log;
use App\Core\Domain\UseCases\Thread\CreateThreadContract;
use App\Core\Domain\UseCases\Thread\CreateThreadInputDto;
use App\Core\Presentation\Helpers\APIResponse;
use App\Core\Presentation\Controllers\CreateThreadControllerContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateThreadController extends Controller implements CreateThreadControllerContract
{
    public function __construct(
        private readonly CreateThreadContract $createThread
    ) {
    }

    public function handle(Request $request): JsonResponse
    {
        try {
            $validate = Validator::make($request->input(), [
                'title' => 'required|string'
            ]);

            if ($validate->fails()) {
                Log::error('Invalid parameters');
                return APIResponse::badRequest($validate->getMessageBag()->all());
            }

            $result = $this->createThread->exec(new CreateThreadInputDto(
                title: $request->title
            ));

            return APIResponse::success(__('createThread.success'), $result);
        } catch(ValidationException $e) {
            return APIResponse::badRequest([$e->getMessage()]);
        } catch (Exception $e) {
            Log::error($e);
            return APIResponse::serverError();
        }
    }
}
