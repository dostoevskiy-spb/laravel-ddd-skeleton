<?php

declare(strict_types=1);

namespace Common\Casts;

use Common\Helpers\PasswordHelper;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PasswordCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): string
    {
        return PasswordHelper::decrypt($value);
    }

    public function set($model, string $key, $value, array $attributes): string
    {
        return PasswordHelper::encrypt($value);
    }
}
