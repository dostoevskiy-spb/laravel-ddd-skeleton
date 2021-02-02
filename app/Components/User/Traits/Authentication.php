<?php

declare(strict_types=1);

namespace Components\User\Common\Traits;

use Common\Exceptions\HttpUnauthorizedException;
use Components\User\Common\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

trait Authentication
{
    protected function attempt(string $email, string $password): string
    {
        $token = Auth::attempt(['email' => $email, 'password' => $password]);
        if ($token === false) {
            throw new HttpUnauthorizedException();
        }

        return $token;
    }

    protected function unAuthorize(): void
    {
        unset($_SERVER['Authorization']);
    }

    public function authorize(Authenticatable $user): void
    {
        $token = Auth::fromUser($user);

        $_SERVER['Authorization'] = "Bearer ${token}";
    }
}
