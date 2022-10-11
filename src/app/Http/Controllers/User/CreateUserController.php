<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Core\Common\Log;
use App\Core\Domain\UseCases\User\CreateUserContract;
use App\Core\Domain\UseCases\User\CreateUserInputDto;
use App\Core\Presentation\APIResponse;
use App\Core\Presentation\Controllers\CreateUserControllerContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateUserController extends Controller implements CreateUserControllerContract
{
    public function __construct(
        private readonly CreateUserContract $createUser
    ) {
    }

    public function handle(Request $request): JsonResponse
    {
        try {
            $validate = Validator::make($request->input(), [
                'full_name' => 'required|string',
                'email' => 'required|string',
                'password' => 'required|string|min:6',
                'bio' => 'sometimes|string|min:2',
            ]);

            if ($validate->fails()) {
                Log::error('Invalid parameters');
                return APIResponse::badRequest($validate->getMessageBag()->all());
            }

            $result = $this->createUser->exec(new CreateUserInputDto(
                email: $request->email,
                full_name: $request->full_name,
                password: $request->password,
                bio: $request->bio
            ));

            return APIResponse::success(__('createUser.success'), $result);
        } catch(ValidationException $e) {
            return APIResponse::badRequest();
        } catch (Exception $e) {
            Log::error($e);
            return APIResponse::serverError();
        }
    }
}
