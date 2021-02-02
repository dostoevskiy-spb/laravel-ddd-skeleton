<?php

declare(strict_types=1);

namespace Common\Exceptions;

use Exception;
use Throwable;

class ValidationException extends Exception
{
    public function __construct($message, ?Throwable $previous = null)
    {
        parent::__construct($message, 422, $previous);
    }
}
