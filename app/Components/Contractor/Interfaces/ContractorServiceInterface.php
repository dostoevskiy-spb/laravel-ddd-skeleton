<?php

declare(strict_types=1);

namespace Components\Contractor\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ContractorServiceInterface
{
    public function getAll(): Collection;
}
