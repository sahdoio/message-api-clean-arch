<?php

namespace App\Http\Controllers\Thread;

use App\Http\Controllers\Controller;
use App\Core\Common\Log;
use App\Core\Domain\UseCases\Thread\ListThreadsContract;
use App\Core\Domain\UseCases\Thread\ListThreadsInputDto;
use App\Core\Presentation\Helpers\APIResponse;
use App\Core\Presentation\Controllers\ListThreadsControllerContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ListThreadsController extends Controller implements ListThreadsControllerContract
{
    public function __construct(
        private readonly ListThreadsContract $listThreads
    ) {
    }

    public function handle(Request $request, int|string $userId): JsonResponse
    {
        try {
            $data = $request->input();
            $data['user_id'] = $userId;
            $validate = Validator::make($data, [
                'user_id' => 'required|integer|not_in:0'
            ]);

            if ($validate->fails()) {
                Log::error('Invalid parameters');
                return APIResponse::badRequest($validate->getMessageBag()->all());
            }

            $result = $this->listThreads->exec(new ListThreadsInputDto(
                user_id: intval($userId),
                title: $request->title
            ));

            return APIResponse::success(__('listThreads.success'), $result);
        } catch (ValidationException $e) {
            return APIResponse::badRequest([$e->getMessage()]);
        } catch (Exception $e) {
            Log::error($e);
            return APIResponse::serverError();
        }
    }
}
