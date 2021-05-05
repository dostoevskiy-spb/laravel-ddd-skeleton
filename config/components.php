<?php

return [
    'user' => [
        'model' => Components\User\User::class,
        'schema' => 'users',
        'seeder' => Components\User\Database\Seeds\UserComponentsSeeder::class,
       /* 'entities' => [
            Components\User\Models\Entity::ID_MEDIA_BUYER =>
                Components\MediaBuyer\MediaBuyer::class,
            Components\User\Models\Entity::ID_ACCOUNT_MANAGER =>
                Components\AccountManager\AccountManager::class,
        ]*/
    ],
];
