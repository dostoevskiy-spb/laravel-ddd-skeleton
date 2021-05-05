<?php

declare(strict_types=1);

namespace Components\User\Interfaces;

use Components\User\User;

interface UserServiceInterface
{
    public function getCurrent(): User;
}
