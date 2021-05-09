<?php

declare(strict_types=1);

namespace Components\Contractor\Database\Seeds;

use Common\Database\Seeds\BaseSeeder;

class ContractorComponentsSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->call([
                        TypesTableSeeder::class,
                        StatusesTableSeeder::class,
                        ContractorsTableSeeder::class,
        ]);
    }
}
