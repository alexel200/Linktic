<?php

namespace Src\products\infrastructure\http\responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class JsonApiResponse
{
    public static function success(mixed $data, int $status = 200): JsonResponse
    {
        $response = ['data' => $data];
        if($data instanceof LengthAwarePaginator){
            $response = [
                'data' => $data->items(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'total' => $data->total(),
            ];
        }

        return response()->json($response, $status);
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
