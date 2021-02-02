<?php

namespace Components\User\Common\Traits;

use Common\Helpers\PasswordHelper;
use Components\User\Common\Interfaces\UserServiceInterface;
use Components\User\Common\Models\Status;
use Components\User\Common\Repositories\UserRepository;
use Components\User\User;

trait Users
{
    public function createUser(int $entityId, string $email, string $password, ?int $statusId = null): User
    {
        return app(UserRepository::class)->create([
            'entity_id' => $entityId,
            'email' => $email,
            'password' => PasswordHelper::getHash($password),
            'status_id' => $statusId ?? Status::ID_ACTIVE
        ]);
    }

    public function getCurrentUser(): ?User
    {
        return app(UserServiceInterface::class)
            ->getCurrent();
    }
}
