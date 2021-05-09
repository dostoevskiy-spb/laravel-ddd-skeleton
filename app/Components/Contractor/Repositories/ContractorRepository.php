<?php

declare(strict_types=1);

namespace Components\Contractor\Repositories;

use Common\Repositories\EloquentRepository;
use Components\Contractor\Contractor;
use Components\Contractor\Interfaces\ContractorRepositoryInterface;
use Components\User\User;
use Illuminate\Support\Collection;

/**
 * Class UserRepository
 *
 * @method User getFirst(array $where)
 */
class ContractorRepository extends EloquentRepository implements ContractorRepositoryInterface
{

    protected function getModel(): string
    {
        return Contractor::class;
    }

    public function getByType(int $types): Collection
    {
        return $this->getQuery()->whereTypeId($types)->get();
    }

    public function getByStatus(int $statuses): Collection
    {
        return $this->getQuery()->whereStatuses($statuses)->get();
    }
}
