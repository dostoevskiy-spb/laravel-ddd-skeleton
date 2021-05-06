<?php

declare(strict_types=1);

namespace Components\Contractor\Interfaces;

use Components\Contractor\Contractor;

interface ContractorRepositoryInterface
{
    public function getByType(int $types): ?Contractor;
}
