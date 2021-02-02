<?php

declare(strict_types=1);

namespace Common\Exceptions;

use Exception;

class HttpUnauthorizedException extends Exception
{
    public function __construct(string $message = 'Unauthorized', ?Exception $previous = null)
    {
        parent::__construct($message, 401, $previous);
    }
}
