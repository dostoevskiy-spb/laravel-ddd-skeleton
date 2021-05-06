<?php

declare(strict_types=1);

namespace Components\Contractor\Database\Seeds;

use Common\Database\Seeds\BaseSeeder;
use Components\Contractor\Database\Factory\ContractorFactory;
use Components\Contractor\Enums\ContractorStatusEnum;
use Components\Contractor\Enums\ContractorTypeEnum;
use Components\User\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ContractorsTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Омником-СПБ',
                'code' => '1234',
                'address' => 'пр. 9 января 3к1',
                'inn' => '7840076216',
                'ogrn' => '1187847032108',
                'status_id' => ContractorStatusEnum::ID_ACTIVE,
                'type_id' => ContractorTypeEnum::ID_OWNER,
            ]

        ];
        $contractors = new ContractorFactory();
        $data = array_merge($data, $contractors->generate(10));
        DB::table('contractors.contractors')->insert($data);
    }
}
