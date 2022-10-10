<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Core\Common\Log;
use App\Core\Domain\UseCases\Authentication\AuthenticationContract;
use App\Core\Domain\UseCases\Authentication\AuthenticationInputDto;
use App\Core\Presentation\APIResponse;
use App\Core\Presentation\Controllers\BaseControllerContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller implements BaseControllerContract
{
    public function __construct(
        private readonly AuthenticationContract $userAuthentication
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

            $userAuthenticationOutputDto = $this->userAuthentication->exec(new AuthenticationInputDto(
                email: $request->email,
                password: $request->password
            ));

            return APIResponse::success(__('authentication.success'), $userAuthenticationOutputDto);
        } catch (Exception $e) {
            Log::error($e);
            return APIResponse::serverError();
        }
    }
}
