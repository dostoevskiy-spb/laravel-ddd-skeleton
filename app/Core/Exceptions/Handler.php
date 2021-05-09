<?php

declare(strict_types=1);

namespace Core\Exceptions;

use Common\Exceptions\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        $exceptionCode = $this->getExceptionCode($exception);

        $errorBody = [
            'code' => $exceptionCode,
            'message' => $exception->getMessage(),
        ];

        if ($this->isValidationException($exception)) {
            $errorBody['message'] = 'Validation failed.';
            $errorBody['errors'] = json_decode($exception->getMessage(), true);
        }

        if ($this->isAuthenticationException($exception)) {
            $errorBody['code'] = Response::HTTP_UNAUTHORIZED;
        }

        if (config('app.debug') !== 'production') {
            $errorBody['trace'] = $exception->getTrace();
        }

        return response()->json($errorBody, $exceptionCode);
    }

    protected function getExceptionCode(Throwable $exception)
    {
        $code = $exception->getCode();

        if (empty($code) || (!is_numeric($code))) {
            return Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $code;
    }

    protected function isValidationException(Throwable $exception): bool
    {
        return $exception instanceof ValidationException;
    }

    protected function isAuthenticationException(Throwable $exception)
    {
        return $exception instanceof AuthenticationException;
    }
}
