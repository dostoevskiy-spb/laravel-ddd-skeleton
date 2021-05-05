<?php

declare(strict_types=1);

namespace Components\User\Middleware;

use Closure;
use Common\Exceptions\HttpUnauthorizedException;
use Components\User\Facades\Auth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\Authenticate as JWTAuth;

class Authenticate extends JWTAuth
{
    public function handle($request, Closure $next)
    {
        if (isset($_SERVER['Authorization'])) {
            $request->headers->set('Authorization', $_SERVER['Authorization']);
        }

        try {
            Auth::parseToken()->authenticate();
        } catch (Exception $exception) {
            throw new HttpUnauthorizedException('Unauthorized');
        }

        return $next($request);
    }
}
