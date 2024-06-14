<?php

use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use App\Exceptions\RestException;
use App\Helpers\ResponseFormatter;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

function dateToString($date, $format = 'D MMMM Y')
{
    $result = null;
    $converted_date = date('Y-m-d H:i:s', strtotime($date));

    if (!empty($date) && !empty($converted_date))
        $result = Carbon::createFromFormat('Y-m-d H:i:s', $converted_date)->isoFormat($format);

    return $result;
}

# encrypt()
function encryptData($data)
{
    return Crypt::encrypt($data);
}

# decrypt() with error handling
function decryptData($encrypted_data)
{
    $result = NULL;

    try {
        $result = Crypt::decrypt($encrypted_data);
    } catch (DecryptException $e) {
        # Invalid Payload
    }

    return $result;
}

function encryptUrlData($data)
{
    return urlencode(encryptData($data));
}

function rest_error($data = null, String $message = null): JsonResponse
{
    return response()->json([
        'metadata' => [
            'status' => 'error',
            'message' => $message,
            'errors' => $data,
        ],
        'response' => $data,
    ], 500);
}

function rest_success($data = null, String $message = null): JsonResponse
{
    return response()->json([
        'status' => 'ok',
        'message' => $message,
        'data' => $data
    ]);
}

function response_success($data = null, String $message = null): JsonResponse
{
    return ResponseFormatter::success($data, $message);
}

function response_error($data = null, String $message = null, array $errors = [], Int $code = 400): JsonResponse
{
    return ResponseFormatter::error($data, $message, $errors, $code);
}

function throw_error(RestException $e): JsonResponse
{
    if ($e->rollbackTrans()) DB::rollBack();
    return response_error($e->getData(), is_debug() ? $e->getMessage() : "Internal server error", $e->getErrors(), $e->getCode());
}

function arrChangeKeyFromValue($array_source, $column_name)
{
    $arr_results = [];

    foreach ($array_source as $value)
        $arr_results[$value[$column_name]] = $value;

    return $arr_results;
}

function getFullUrlStorage($url)
{
    return env('URL_STORAGE') . $url;
}
