<?php

declare(strict_types=1);

namespace Components\User\Http\Versions\v1\Controllers;

use App\Components\User\Http\Versions\v1\Presenters\LogoutPresenter;
use Common\Controllers\Controller;
use Components\User\Interfaces\AuthenticationServiceInterface;
use Components\User\Versions\v1\Presenters\TokenPresenter;
use Components\User\Versions\v1\Requests\AuthenticationRequest;
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
     *
     * @param AuthenticationRequest $request
     * @return JsonResponse
     */
    public function login(AuthenticationRequest $request): JsonResponse
    {
        $token = $this->service->authenticate($request->email, $request->password);

        return (new TokenPresenter($token))
            ->present();
    }

    /**
     * Log user out
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->invalidate();

        return (new LogoutPresenter())->present();
    }
}
