<?php

use Components\Contractor\Contractor;
use Components\Contractor\Database\Seeds\ContractorComponentsSeeder;

return [
    'model' => Contractor::class,
    'schema' => 'contractors',
    'seeder' => ContractorComponentsSeeder::class,
];
