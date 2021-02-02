<?php

declare(strict_types=1);

namespace Components\User\Providers;

use Components\User\Common\Interfaces\AuthenticationServiceInterface;
use Components\User\Common\Interfaces\UserRepositoryInterface;
use Components\User\Common\Interfaces\UserServiceInterface;
use Components\User\Common\Repositories\UserRepository;
use Components\User\Common\Services\AuthenticationService;
use Components\User\Common\Services\UserService;
use Illuminate\Support\ServiceProvider;

class UserProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
