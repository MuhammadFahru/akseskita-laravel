<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;

class ResponseFormatter
{
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => null,
            'errors' => []
        ],
        'data' => null,
    ];

    public static function success($data = null, $message = null)
    {
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return Config::get('auth.type') === 'web' ? response()->json(self::$response, self::$response['meta']['code']) : rest_success($data, $message);
    }

    public static function error($data = null, $message = null, $errors = [], $code = 400)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['meta']['errors'] = $errors;
        self::$response['data'] = $data;

        return Config::get('auth.type') === 'web' ? response()->json(self::$response, self::$response['meta']['code']) : rest_error($data ?: $errors, $message);
    }
}
