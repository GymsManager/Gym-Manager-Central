<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

/**
 * @OA\Info(
 *     title="Gym Multi-Tenant API",
 *     version="1.0.0",
 *     description="API documentation for the Laravel Gym Management system"
 * )
 *
 * @OA\Tag(name="Auth")
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(protected AuthService $authService) {}

    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     tags={"Auth"},
     *     summary="Register a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(response=201, description="User registered")
     * )
     */

     public function register(RegisterRequest $request): JsonResponse
     {
         $result = $this->authService->register($request->validated());
         return $this->success($result, 'User registered successfully', 201);
     }

    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     tags={"Auth"},
     *     summary="Login a user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Login successful")
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->login($request->validated());
            return $this->success($result, 'Login successful');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), null, 401);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/me",
     *     tags={"Auth"},
     *     summary="Get current authenticated user",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="User profile")
     * )
     */
    public function me(): JsonResponse
    {
        return $this->success($this->authService->me(), 'Authenticated user');
    }


    /**
     * @OA\Post(
     *     path="/api/v1/logout",
     *     tags={"Auth"},
     *     summary="Logout the user",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="User logged out")
     * )
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return $this->success(null, 'Logged out');
    }

    /**
     * @OA\Post(
     *     path="/api/v1/refresh",
     *     tags={"Auth"},
     *     summary="Refresh JWT token",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Token refreshed")
     * )
     */
    public function refresh(): JsonResponse
    {
        return $this->success($this->authService->refresh(), 'Token refreshed');
    }
}
