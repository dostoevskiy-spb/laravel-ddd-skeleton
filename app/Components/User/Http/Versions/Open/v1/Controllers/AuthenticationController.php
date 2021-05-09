<?php

declare(strict_types=1);

namespace Components\User\Http\Versions\Open\v1\Controllers;

use Common\Controllers\Controller;
use Components\User\Interfaces\AuthenticationServiceInterface;
use Components\User\Http\Versions\Open\v1\Presenters\LogoutPresenter;
use Components\User\Http\Versions\Open\v1\Presenters\TokenPresenter;
use Components\User\Http\Versions\Open\v1\Requests\AuthenticationRequest;
use Illuminate\Http\JsonResponse;

class AuthenticationController extends Controller
{
    /**
     * @var AuthenticationServiceInterface
     */
    protected $service;

    public function __construct(AuthenticationServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Authenticate user uses jwt token
     */
    public function login(AuthenticationRequest $request): JsonResponse
    {
        $token = $this->service->authenticate($request->email, $request->password);

        return (new TokenPresenter($token))
            ->present();
    }

    /**
     * Log user out
     */
    public function logout(): JsonResponse
    {
        auth()->invalidate();

        return (new LogoutPresenter())->present();
    }
}
