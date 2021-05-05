<?php

declare(strict_types=1);

namespace Components\User\Services;

use Common\Exceptions\HttpUnauthorizedException;
use Common\Services\BaseService;
use Components\User\Facades\Auth;
use Components\User\Interfaces\UserServiceInterface;
use Components\User\Repositories\UserRepository;
use Components\User\User;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserService extends BaseService implements UserServiceInterface
{
    /**
     * @var UserRepository
     */
    protected $repository;

    public function getCurrent(): User
    {
        try {
            $user = Auth::parseToken()->authenticate();
        } catch (JWTException $exception) {
            throw new HttpUnauthorizedException();
        }

        if ($user === false) {
            throw new HttpUnauthorizedException();
        }

        return $user;
    }

    protected function getRepository(): string
    {
        return UserRepository::class;
    }
}
