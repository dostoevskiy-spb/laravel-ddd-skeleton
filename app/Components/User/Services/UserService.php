<?php

declare(strict_types=1);

namespace Components\User\Common\Services;

use Common\Exceptions\HttpUnauthorizedException;
use Common\Services\BaseService;
use Components\User\Common\Facades\Auth;
use Components\User\Common\Interfaces\UserServiceInterface;
use Components\User\Common\Repositories\UserRepository;
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
