<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function success($data, $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ], $code);
    }

    public function successMessage($message, $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], $code);
    }

    public function failed($message, $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }

    public function errors($error, $code = 400): JsonResponse
    {
        return response()->json([
            'error' => $error
        ], $code);
    }
}
