<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Core\Common\Log;
use App\Core\Domain\UseCases\User\FindUserContract;
use App\Core\Domain\UseCases\User\FindUserInputDto;
use App\Core\Presentation\Helpers\APIResponse;
use App\Core\Presentation\Controllers\FindUserControllerContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class FindUserController extends Controller implements FindUserControllerContract
{
    public function __construct(
        private readonly FindUserContract $findUser
    ) {
    }

    public function handle(int $id): JsonResponse
    {
        try {
            $result = $this->findUser->exec(new FindUserInputDto(id: $id));

            return APIResponse::success(__('getUser.success'), $result);
        } catch(ValidationException $e) {
            return APIResponse::badRequest();
        } catch (Exception $e) {
            Log::error($e);
            return APIResponse::serverError();
        }
    }
}
