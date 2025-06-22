<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ApiExceptionHandler implements ExceptionHandler
{
    public function report(Throwable $e): void {}

    public function render($request, Throwable $e)
    {
        // Default status code
        $status = 500;

        if ($e instanceof QueryException && $e->getCode() == 23000) {
            // Try to extract the duplicate field from the error message
            $message = 'Duplicate entry';
            if (preg_match("/Duplicate entry '.*' for key '(.+)'/", $e->getMessage(), $matches)) {
                $field = $matches[1];
                $message = "Duplicate entry for unique field: $field";
            }
            return response()->json([
                'success' => false,
                'message' => $message,
                'status' => 409
            ], 409);
        }

        if ($e instanceof ModelNotFoundException) {
            $status = 404;
            $model = class_basename($e->getModel());
            return response()->json([
                'success' => false,
                'message' => "{$model} not found.",
                'status' => $status
            ], $status);
        }

        if ($e instanceof UnauthorizedHttpException) {
            $status = 401;
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
                'status' => $status
            ], $status);
        }

        if ($e instanceof ValidationException) {
            $status = 422;
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'status' => $status
            ], $status);
        }

        if ($e instanceof AuthenticationException) {
            $status = 401;
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
                'status' => $status
            ], $status);
        }

        if ($e instanceof NotFoundHttpException) {
            $status = 404;
            return response()->json([
                'success' => false,
                'message' => 'Route not found',
                'status' => $status
            ], $status);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            $status = 405;
            return response()->json([
                'success' => false,
                'message' => 'Method not allowed',
                'status' => $status
            ], $status);
        }

        // Fallback
        return response()->json([
            'success' => false,
            'message' => $e->getMessage() ?: 'Server Error',
            'status' => $status
        ], $status);
    }

    public function shouldReport(Throwable $e): bool
    {
        return false;
    }

    public function renderForConsole($output, Throwable $e): void
    {
        $output->writeln((string) $e);
    }
}
