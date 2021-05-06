<?php

use App\Components\User\Enums\UserEntityEnum;
use App\Models\User;

return [
    'model' => Components\User\User::class,
    'schema' => 'users',
    'seeder' => Components\User\Database\Seeds\UserComponentsSeeder::class,
    'entities' => [
        UserEntityEnum::ID_ADMIN => User::class,
        UserEntityEnum::ID_DEVELOPER => User::class,
        UserEntityEnum::ID_ORGANIZATION_OWNER => User::class,
        UserEntityEnum::ID_MANAGER => User::class,
        UserEntityEnum::ID_MASTER => User::class,
    ]
];
