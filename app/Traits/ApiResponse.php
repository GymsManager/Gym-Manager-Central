<?php

namespace App\Traits;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\ModelNotFoundException;
>>>>>>> 51bd07d (Gym-review)

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

<<<<<<< HEAD
=======
        if ($errors instanceof ModelNotFoundException) {
            $model = class_basename($errors->getModel());

            return $this->error("{$model} not found.", null, 404);
        }

>>>>>>> 51bd07d (Gym-review)
        if (!is_null($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}
