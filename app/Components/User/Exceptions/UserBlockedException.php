<?php

declare(strict_types=1);

namespace Components\User\Exceptions;

use Exception;
use Throwable;

class UserBlockedException extends Exception
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct('User is blocked', 400, $previous);
    }
}
