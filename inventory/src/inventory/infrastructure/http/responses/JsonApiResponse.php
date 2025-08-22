<?php

namespace Src\inventory\infrastructure\http\responses;

use Illuminate\Http\JsonResponse;
class JsonApiResponse
{
    public static function success(mixed $data, int $status = 200): JsonResponse
    {
        return response()->json([
            'data' => $data
        ], $status);
    }

    public static function error(string $detail, int $status): JsonResponse
    {
        return response()->json([
            'errors' => [[
                'status' => (string) $status,
                'detail' => $detail
            ]]
        ], $status);
    }
}
