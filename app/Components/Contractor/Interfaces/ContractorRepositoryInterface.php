<?php

declare(strict_types=1);

namespace Components\Contractor\Interfaces;

use Illuminate\Support\Collection;

interface ContractorRepositoryInterface
{
    public function getByType(int $types): Collection;

    public function getByStatus(int $statuses): Collection;
}
