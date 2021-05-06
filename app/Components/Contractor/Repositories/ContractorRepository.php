<?php

declare(strict_types=1);

namespace Components\Contractor\Repositories;

use Common\Models\BaseModel;
use Common\Repositories\EloquentRepository;
use Components\Contractor\Contractor;
use Components\Contractor\Interfaces\ContractorRepositoryInterface;
use Components\User\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserRepository
 *
 * @method User getFirst(array $where)
 */
class ContractorRepository extends EloquentRepository implements ContractorRepositoryInterface
{

    /**
     * @param array $data
     * @return BaseModel|Contractor|Builder
     */
    public function create(array $data): BaseModel
    {
        return Contractor::create($data);
    }

    protected function getModel(): string
    {
        return Contractor::class;
    }

    public function getByType(int $types): ?Contractor
    {
        // TODO: Implement getByType() method.
    }
}
