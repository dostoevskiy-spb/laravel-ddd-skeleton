<?php

declare(strict_types=1);

namespace Components\User\Common\Interfaces;

interface AuthenticationServiceInterface
{
    public function authenticate(string $email, string $password): string;
}
