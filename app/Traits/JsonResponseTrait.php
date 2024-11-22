<?php

namespace App\Traits;

trait JsonResponseTrait
{
    /**
     * Returns a successful JSON response.
     *
     * @param mixed  $data       the response data
     * @param string $message    the response message
     * @param int    $statusCode the HTTP status code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse(mixed $data = null, ?string $message = null, int $statusCode = 200)
    {
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }

    /**
     * Returns a error JSON response.
     *
     * @param mixed  $data       the response data
     * @param int    $statusCode the HTTP status code
     * @param string $message    the response message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse(mixed $data = null, int $statusCode = 500, ?string $message = null)
    {
        return response()->json([
            'status' => false,
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }
}
