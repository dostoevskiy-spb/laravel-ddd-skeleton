<?php

declare(strict_types=1);

namespace Components\User\Database\Seeds;

use Common\Database\Seeds\BaseSeeder;
use Components\User\Common\Models\Status;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users.statuses')->insert([
            [
                'id' => Status::ID_BLOCKED,
                'name' => 'bocked',
            ],
            [
                'id' => Status::ID_ACTIVE,
                'name' => 'active',
            ],
        ]);
    }
}
