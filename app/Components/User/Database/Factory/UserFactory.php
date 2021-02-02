<?php

declare(strict_types=1);

namespace Components\User\Database\Factory;

use Common\Database\Factory\AbstractFactory;
use Components\User\Common\Models\Entity;
use Components\User\Common\Models\Status;
use Components\User\User;

class UserFactory extends AbstractFactory
{
    protected function getFields(): array
    {
        return [
            'email' => $this->faker->email,
            'password' => $this->faker->password(),
            'status_id' => Status::ID_ACTIVE,
            'entity_id' => Entity::ID_ADMIN,
        ];
    }

    protected function getModel(): string
    {
        return User::class;
    }
}
