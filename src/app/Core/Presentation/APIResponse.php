<?php

namespace App\Core\Presentation;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

/**
 * API response class
 */
class APIResponse
{
    /**
     * Codes
     */
    public const CODES = [
        Response::HTTP_OK                    => 'SUCCESS',
        Response::HTTP_NOT_FOUND             => 'NOT_FOUND',
        Response::HTTP_BAD_REQUEST           => 'BAD_REQUEST',
        Response::HTTP_INTERNAL_SERVER_ERROR => 'INTERNAL_ERROR',
        Response::HTTP_UNAUTHORIZED          => 'UNAUTHORIZED',
        Response::HTTP_FORBIDDEN             => 'FORBIDDEN',
    ];

    /**
     * Mount response function
     *
     * @param int          $status
     * @param array|string $messages
     * @param array        $data
     * @param string       $token
     *
     * @return JsonResponse
     */
    private static function mountResponse(
        int $status,
        $messages,
        mixed $data = null,
        string $token = ''
    ): JsonResponse {
        if (is_string($messages)) {
            $messages = [$messages];
        }

        $headers = [];

        if (!empty($token)) {
            $headers = [
                'Authorization' => sprintf('Bearer %s', $token),
                'Accept' => 'application/json',
            ];
        }

        $response = ['status' => Arr::get(self::CODES, $status, '')];

        if ($messages) {
            $response['messages'] = $messages;
        }

        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response, $status, $headers);
    }

    /**
     * Success response
     *
     * @param array $messages
     * @param mixed $data
     * @param string $token
     *
     * @return JsonResponse
     */
    public static function success(
        $messages = [],
        mixed $data = null,
        string $token = ''
    ): JsonResponse {
        return self::mountResponse(Response::HTTP_OK, $messages, $data, $token);
    }

    /**
     * Not found response
     *
     * @param array|string $messages
     *
     * @return JsonResponse
     */
    public static function notFound($messages = []): JsonResponse
    {
        return self::mountResponse(Response::HTTP_NOT_FOUND, $messages);
    }

    /**
     * Bad request response
     *
     * @param array|string $messages
     *
     * @return JsonResponse
     */
    public static function badRequest($messages = []): JsonResponse
    {
        return self::mountResponse(Response::HTTP_BAD_REQUEST, $messages);
    }

    /**
     * Server response
     *
     * @param array|string $messages
     *
     * @return JsonResponse
     */
    public static function serverError($messages = []): JsonResponse
    {
        return self::mountResponse(
            Response::HTTP_INTERNAL_SERVER_ERROR,
            $messages
        );
    }

    /**
     * Unauthorized response
     *
     * @param array|string $messages
     *
     * @return JsonResponse
     */
    public static function unauthorized($messages = []): JsonResponse
    {
        return self::mountResponse(Response::HTTP_UNAUTHORIZED, $messages);
    }

    /**
     * Forbidden response
     *
     * @param array|string $messages
     *
     * @return JsonResponse
     */
    public static function forbidden($messages = []): JsonResponse
    {
        return self::mountResponse(Response::HTTP_FORBIDDEN, $messages);
    }
}
