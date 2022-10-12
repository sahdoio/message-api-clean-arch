<?php

namespace App\Http\Controllers\Message;

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

class ListMessagesController extends Controller implements ListMessagesControllerContract
{
    public function __construct(
        private readonly ListMessagesContract $listMessages
    ) {
    }

    public function handle(Request $request, int|string $threadId): JsonResponse
    {
        try {
            $data = $request->input();
            $data['thread_id'] = $threadId;
            $validate = Validator::make($data, [
                'thread_id' => 'required|integer|not_in:0',
                'user_id' => 'sometimes|integer|not_in:0',
                'body' => 'sometimes|string|min:2',
            ]);

            if ($validate->fails()) {
                Log::error('Invalid parameters');
                return APIResponse::badRequest($validate->getMessageBag()->all());
            }

            $result = $this->listMessages->exec(new ListMessagesInputDto(
                thread_id: $threadId,
                user_id: $request->user_id,
                body: $request->body
            ));

            return APIResponse::success(__('listMessages.success'), $result);
        } catch (ValidationException $e) {
            return APIResponse::badRequest([$e->getMessage()]);
        } catch (Exception $e) {
            Log::error($e);
            return APIResponse::serverError();
        }
    }
}
