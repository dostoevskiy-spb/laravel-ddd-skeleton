<?php

declare(strict_types=1);

namespace Components\Contractor\Database\Seeds;

use Common\Database\Seeds\BaseSeeder;
use Components\Contractor\Enums\ContractorTypeEnum;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contractors.types')->insert([
            [
//                'id' => ContractorTypeEnum::ID_OWNER,
                'name' => 'Владелец',
            ],
            [
//                'id' => ContractorTypeEnum::ID_ORGANIZATION_TO_SERVE,
                'name' => 'На обслуживании',
            ],
            [
//                'id' => ContractorTypeEnum::ID_PROVIDER,
                'name' => 'Поставщик',
            ],
        ]);
    }
}
