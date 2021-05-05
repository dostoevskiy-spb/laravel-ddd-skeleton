<?php

declare(strict_types=1);

namespace Components\User\Services;

use Components\User\Exceptions\UserBlockedException;
use Components\User\Interfaces\AuthenticationServiceInterface;
use Components\User\Interfaces\UserRepositoryInterface;
use Components\User\Models\Status;
use Components\User\Traits\Authentication;

class AuthenticationService implements AuthenticationServiceInterface
{
    use Authentication;

    /**
     * @var UserRepositoryInterface
     */
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function authenticate(string $email, string $password): string
    {
        $user = $this->repository->getByEmail($email);

        if ($this->isBlocked($user->status_id)) {
            throw new UserBlockedException();
        }

        return $this->attempt($email, $password);
    }

    protected function isBlocked(int $statusId): bool
    {
        return $statusId === Status::ID_BLOCKED;
    }
}
