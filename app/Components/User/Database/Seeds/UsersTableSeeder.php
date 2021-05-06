<?php

declare(strict_types=1);

namespace Components\User\Database\Seeds;

use App\Components\User\Enums\UserEntityEnum;
use Common\Database\Seeds\BaseSeeder;
use Components\User\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users.users')->insert([
            [
                'entity_id' => UserEntityEnum::ID_ADMIN,
                'status_id' => Status::ID_ACTIVE,
                'email' => config('database.admin.email'),
                'password' => Hash::make(config('database.admin.password')),
            ]
        ]);
    }
}
