<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Traits\ApiResponse;

class HandleJwtExceptions
{
    use ApiResponse;

    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (TokenExpiredException $e) {
            return $this->error('Token has expired', null, 401);
        } catch (TokenInvalidException $e) {
            return $this->error('Token is invalid', null, 401);
        } catch (JWTException $e) {
            return $this->error('Token not provided', null, 401);
        } catch (Exception $e) {
            return $this->error('Authentication error', ['exception' => $e->getMessage()], 401);
        }
    }
}
