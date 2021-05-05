<?php

declare(strict_types=1);

namespace Components\User\Interfaces;

interface AuthenticationServiceInterface
{
    public function authenticate(string $email, string $password): string;
}
