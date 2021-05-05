<?php

declare(strict_types=1);

namespace Components\User\Http\Versions\v1\Requests;

use Common\Requests\BaseRequest;
use Components\User\User;

/**
 * Class AuthenticationRequest
 *
 * @property string email
 * @property string password
 */
class AuthenticationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:' . User::class,
            'password' => 'required|min:6|max:50',
        ];
    }
}
