<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait ApiResponse
{
    protected function success($data = null, $message = 'Success', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'status' => $code
        ], $code);
    }

    protected function error($message = 'Error', $errors = null, $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $message,
            'status' => $code
        ];

        if ($errors instanceof ModelNotFoundException) {
            $model = class_basename($errors->getModel());

            return $this->error("{$model} not found.", null, 404);
        }

        if (!is_null($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}
