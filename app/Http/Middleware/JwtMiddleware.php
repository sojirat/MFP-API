<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware extends Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $token = JWTAuth::getToken();

        if ($token && $this->isTokenBlacklisted($token)) {
            return response()->json([
                'status' => false,
                'message' => 'Token is Invalid',
            ], 401);
        }

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token is Invalid',
            ], 401);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token is Expired',
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Authorization Token not found',
            ], 401);
        }

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated',
            ], 401);
        }

        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     * Check if the token is blacklisted.
     *
     * @param  string  $token
     * @return bool
     */
    protected function isTokenBlacklisted($token)
    {
        return Cache::has('blacklisted_tokens:' . $token);
    }
}
