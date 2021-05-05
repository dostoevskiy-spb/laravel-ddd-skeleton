<?php

declare(strict_types=1);

namespace Components\User\Http\Versions\Personal\v1\Controllers;

use Common\Controllers\Controller;
use Components\User\Interfaces\UserServiceInterface;
use Components\User\Http\Versions\Admin\v1\Presenters\UserPresenter;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    protected $service;

    /**
     * UserController constructor.
     *
     * @param UserServiceInterface $service
     */
    public function __construct(UserServiceInterface $service)
    {
        $this->middleware('auth');

        $this->service = $service;
    }

    /**
     * Get current authenticated user
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $user = $this->service->getCurrent();

        return (new UserPresenter($user))
            ->present();
    }
}
