<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * return api response success
     *
     * @param Array $data
     * @param String $message
     * @param Int $code
     * @param Array $additional_data
     *
     * @return JsonResponse
     */
    protected function api_response_success(String $message, array $data = [], array $additional_data = [], Int $response_code = 200): JsonResponse
    {
        return response()->json(
            array_merge([
                'metadata' => [
                    'status' => 'success',
                    'message' => $message,
                    'errors' => [],
                ],
                'response' => $data,
            ], $additional_data),
            $response_code
        );
    }


    /**
     * return api response error
     *
     * @param Array $data
     * @param String $message
     * @param Int $code
     * @param Array $errors
     *
     * @return JsonResponse
     */
    protected function api_response_error(String $message, array $data = [], array $errors = [], Int $response_code = 500): JsonResponse
    {
        return response()->json([
            'metadata' => [
                'status' => 'error',
                'message' => $message,
                'errors' => $errors,
            ],
            'response' => $data,
        ], $response_code);
    }


    /**
     * return api response error
     *
     * @param Array $data
     * @param String $message
     * @param Int $code
     * @param Array $errors
     *
     * @return JsonResponse
     */
    protected function api_response_validator(String $message, array $data = [], array $errors = [], Int $response_code = 400): JsonResponse
    {
        return response()->json([
            'metadata' => [
                'status' => 'error',
                'message' => $message,
                'errors' => $errors,
            ],
            'response' => $data,
        ], $response_code);
    }
}
