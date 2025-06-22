<?php

namespace app\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(
        protected UserRepositoryInterface $userRepo
    ) {}

    public function register(array $data): array
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepo->create($data);
        $token = JWTAuth::fromUser($user);

        return [
            'user' => $user,
            'token' => $token,
            'expires_in_minutes' => config('jwt.ttl'),
        ];
    }

    public function login(array $credentials): array
    {
        if (!$token = auth('api')->setTTL(config('jwt.ttl'))->attempt($credentials)) {
            throw new \Exception('Invalid credentials');
        }

        return [
            'token' => $token,
            'expires_in_minutes' => config('jwt.ttl'),
        ];
    }

    public function me(): mixed
    {
        return auth('api')->user();
    }

    public function logout(): void
    {
        auth('api')->logout();
    }

    public function refresh(): array
    {
        return [
            'token' => auth('api')->refresh(),
            'expires_in_minutes' => config('jwt.ttl'),
        ];
    }
}
