<?php

declare(strict_types=1);

namespace Components\Contractor\Database\Factory;

use Common\Database\Factory\AbstractFactory;
use Components\Contractor\Enums\ContractorStatusEnum;
use Components\Contractor\Enums\ContractorTypeEnum;
use Components\Contractor\Models\Type;
use Components\Contractor\Models\Status;
use Components\User\User;

class ContractorFactory extends AbstractFactory
{
    protected function getFields(): array
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'code' => $this->faker->randomNumber(6),
            'inn' => $this->faker->numberBetween(1000000000),
            'ogrn' => $this->faker->numberBetween(10000000000),
            'status_id' => $this->faker ->randomElement(ContractorStatusEnum::getList()),
            'type_id' => $this->faker ->randomElement([ContractorTypeEnum::ID_PROVIDER, ContractorTypeEnum::ID_ORGANIZATION_TO_SERVE]),
        ];
    }

    protected function getModel(): string
    {
        return User::class;
    }
}
