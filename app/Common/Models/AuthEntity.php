<?php

declare(strict_types=1);

namespace Common\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

class AuthEntity extends BaseModel implements AuthenticatableContract, AuthorizableContract//, CanResetPasswordContract
{
    use Notifiable;
    use Authorizable;
    use Authenticatable;
//    use CanResetPassword;
//    use MustVerifyEmail;
}
