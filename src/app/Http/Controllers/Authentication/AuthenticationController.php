<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Core\Common\Log;
use App\Core\Domain\UseCases\Authentication\AuthenticationContract;
use App\Core\Domain\UseCases\Authentication\AuthenticationInputDto;
use App\Core\Presentation\APIResponse;
use App\Core\Presentation\Controllers\AuthenticationControllerContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller implements AuthenticationControllerContract
{
    public function __construct(
        private readonly AuthenticationContract $authentication
    ) {
    }

    public function handle(Request $request): JsonResponse
    {
        try {
            $validate = Validator::make($request->input(), [
                'email' => 'required|string',
                'password' => 'required|string|min:6',
            ]);

            if ($validate->fails()) {
                Log::error('Invalid parameters');
                return APIResponse::badRequest($validate->getMessageBag()->all());
            }

            $result = $this->authentication->exec(new AuthenticationInputDto(
                email: $request->email,
                password: $request->password
            ));

            return APIResponse::success(__('authentication.success'), $result);
        } catch (ValidationException $e) {
            return APIResponse::unauthorized();
        } catch (Exception $e) {
            Log::error($e);
            return APIResponse::serverError();
        }
    }
}
