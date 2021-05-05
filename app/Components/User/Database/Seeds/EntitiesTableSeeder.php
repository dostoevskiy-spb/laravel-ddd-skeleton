<?php

declare(strict_types=1);

namespace Components\User\Database\Seeds;

use Common\Database\Seeds\BaseSeeder;
use Components\User\Models\Entity;
use Illuminate\Support\Facades\DB;

class EntitiesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users.entities')->insert(
            [
                [
                    'id'   => Entity::ID_DEVELOPER,
                    'name' => 'Разработчик',
                ],
                [
                    'id'   => Entity::ID_ADMIN,
                    'name' => 'Администратор',
                ],
                [
                    'id'   => Entity::ID_MANAGER,
                    'name' => 'Менеджер',
                ],
                [
                    'id'   => Entity::ID_MASTER,
                    'name' => 'Мастер',
                ],
                [
                    'id'   => Entity::ID_ORGANIZATION_OWNER,
                    'name' => 'Администратор Контрагента',
                ],
            ]
        );
    }
}
