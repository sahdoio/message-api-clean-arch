<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Core\Common\Log;
use App\Core\Domain\UseCases\Message\UpdateMessageContract;
use App\Core\Domain\UseCases\Message\UpdateMessageInputDto;
use App\Core\Presentation\Helpers\APIResponse;
use App\Core\Presentation\Controllers\UpdateMessageControllerContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UpdateMessageController extends Controller implements UpdateMessageControllerContract
{
    public function __construct(
        private readonly UpdateMessageContract $updateMessage
    ) {
    }

    public function handle(Request $request, int|string $messageId): JsonResponse
    {
        try {
            $data = $request->input();
            $data['message_id'] = $messageId;
            $validate = Validator::make($data, [
                'message_id' => 'required|integer|not_in:0',
                'body' => 'required|string'
            ]);

            if ($validate->fails()) {
                Log::error('Invalid parameters');
                return APIResponse::badRequest($validate->getMessageBag()->all());
            }

            $result = $this->updateMessage->exec($messageId, new UpdateMessageInputDto(
                body: $request->body
            ));

            return APIResponse::success(__('updateMessage.success'), $result);
        } catch(ValidationException $e) {
            return APIResponse::badRequest([$e->getMessage()]);
        } catch (Exception $e) {
            Log::error($e);
            return APIResponse::serverError();
        }
    }
}
