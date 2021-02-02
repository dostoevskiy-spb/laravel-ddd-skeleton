<?php

namespace Components\User\Database\Seeds;

use Common\Database\Seeds\BaseSeeder;

class UserComponentsSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->call([
            EntitiesTableSeeder::class,
            StatusesTableSeeder::class,
            UsersTableSeeder::class,
        ]);
    }
}
