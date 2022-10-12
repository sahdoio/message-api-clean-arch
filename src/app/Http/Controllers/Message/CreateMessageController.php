<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Core\Common\Log;
use App\Core\Domain\UseCases\Message\CreateMessageContract;
use App\Core\Domain\UseCases\Message\CreateMessageInputDto;
use App\Core\Presentation\Helpers\APIResponse;
use App\Core\Presentation\Controllers\CreateMessageControllerContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateMessageController extends Controller implements CreateMessageControllerContract
{
    public function __construct(
        private readonly CreateMessageContract $createMessage
    ) {
    }

    public function handle(Request $request): JsonResponse
    {
        try {
            $validate = Validator::make($request->input(), [
                'user_id' => 'required|integer',
                'thread_id' => 'required|integer',
                'body' => 'required|string'
            ]);

            if ($validate->fails()) {
                Log::error('Invalid parameters');
                return APIResponse::badRequest($validate->getMessageBag()->all());
            }

            $result = $this->createMessage->exec(new CreateMessageInputDto(
                user_id: $request->user_id,
                thread_id: $request->thread_id,
                body: $request->body
            ));

            return APIResponse::success(__('createMessage.success'), $result);
        } catch(ValidationException $e) {
            return APIResponse::badRequest([$e->getMessage()]);
        } catch (Exception $e) {
            Log::error($e);
            return APIResponse::serverError();
        }
    }
}
