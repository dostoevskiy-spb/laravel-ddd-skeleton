<?php

declare(strict_types=1);

namespace Components\Contractor\Enums;

use Common\Enums\AbstractEnum;

class ContractorTypeEnum extends AbstractEnum
{
    public const ID_OWNER = 1;
    public const ID_ORGANIZATION_TO_SERVE = 2;
    public const ID_PROVIDER = 2;
}
