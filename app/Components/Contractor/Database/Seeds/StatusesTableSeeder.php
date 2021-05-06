<?php

declare(strict_types=1);

namespace Components\Contractor\Database\Seeds;

use Common\Database\Seeds\BaseSeeder;
use Components\Contractor\Enums\ContractorStatusEnum;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contractors.statuses')->insert([
            [
                'id' => ContractorStatusEnum::ID_BLOCKED,
                'name' => 'Заблокирован',
            ],
            [
                'id' => ContractorStatusEnum::ID_ACTIVE,
                'name' => 'Активен',
            ],
        ]);
    }
}
