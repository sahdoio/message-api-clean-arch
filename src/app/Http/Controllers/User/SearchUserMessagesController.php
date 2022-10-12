<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Core\Common\Log;
use App\Core\Domain\UseCases\Message\ListMessagesContract;
use App\Core\Domain\UseCases\Message\ListMessagesInputDto;
use App\Core\Presentation\Helpers\APIResponse;
use App\Core\Presentation\Controllers\ListMessagesControllerContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SearchUserMessagesController extends Controller implements ListMessagesControllerContract
{
    public function __construct(
        private readonly ListMessagesContract $listMessages
    ) {
    }

    public function handle(Request $request, int|string $userId): JsonResponse
    {
        try {
            $data = $request->input();
            $data['user_id'] = $userId;
            $validate = Validator::make($data, [
                'user_id' => 'required|integer|not_in:0',
                'search_term' => 'sometimes|string|min:2',
                'thread_id' => 'sometimes|integer|not_in:0'
            ]);

            if ($validate->fails()) {
                Log::error('Invalid parameters');
                return APIResponse::badRequest($validate->getMessageBag()->all());
            }

            $result = $this->listMessages->exec(new ListMessagesInputDto(
                user_id: $request->user_id,
                thread_id: $request->thread_id,
                body: $request->search_term
            ));

            return APIResponse::success(__('searchUserMessages.success'), $result);
        } catch (ValidationException $e) {
            return APIResponse::badRequest([$e->getMessage()]);
        } catch (Exception $e) {
            Log::error($e);
            return APIResponse::serverError();
        }
    }
}
