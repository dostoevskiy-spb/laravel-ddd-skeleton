<?php

declare(strict_types=1);

namespace Components\User\Database\Seeds;

use App\Components\User\Enums\UserEntityEnum;
use Common\Database\Seeds\BaseSeeder;
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
                    'id'   => UserEntityEnum::ID_DEVELOPER,
                    'name' => 'Разработчик',
                ],
                [
                    'id'   => UserEntityEnum::ID_ADMIN,
                    'name' => 'Администратор',
                ],
                [
                    'id'   => UserEntityEnum::ID_MANAGER,
                    'name' => 'Менеджер',
                ],
                [
                    'id'   => UserEntityEnum::ID_MASTER,
                    'name' => 'Мастер',
                ],
                [
                    'id'   => UserEntityEnum::ID_ORGANIZATION_OWNER,
                    'name' => 'Администратор Контрагента',
                ],
            ]
        );
    }
}
