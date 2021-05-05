<?php

declare(strict_types=1);

namespace Components\User\Facades;

use Components\User\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class Auth
 *
 * @method static bool|string attempt(array $credentials)
 * @method static parseToken()
 * @method static User fromUser(Authenticatable $user)
 */
class Auth extends JWTAuth
{
}
