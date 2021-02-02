<?php

declare(strict_types=1);

namespace Components\User\Common\Services;

use Components\User\Common\Exceptions\UserBlockedException;
use Components\User\Common\Interfaces\AuthenticationServiceInterface;
use Components\User\Common\Interfaces\UserRepositoryInterface;
use Components\User\Common\Models\Status;
use Components\User\Common\Traits\Authentication;

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
