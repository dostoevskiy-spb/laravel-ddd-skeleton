<?php

declare(strict_types=1);

namespace Components\User\Providers;

use Components\User\Interfaces\AuthenticationServiceInterface;
use Components\User\Interfaces\UserRepositoryInterface;
use Components\User\Interfaces\UserServiceInterface;
use Components\User\Repositories\UserRepository;
use Components\User\Services\AuthenticationService;
use Components\User\Services\UserService;
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
