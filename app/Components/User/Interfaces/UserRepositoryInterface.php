<?php

declare(strict_types=1);

namespace Components\User\Interfaces;

use Components\User\User;

interface UserRepositoryInterface
{
    public function getByEmail(string $email): ?User;
}
