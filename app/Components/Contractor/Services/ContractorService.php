<?php

declare(strict_types=1);

namespace Components\Contractor\Services;

use Common\Repositories\Interfaces\RepositoryInterface;
use Common\Services\BaseService;
use Components\Contractor\Contractor;
use Components\Contractor\Interfaces\ContractorServiceInterface;
use Components\Contractor\Repositories\ContractorRepository;
use Illuminate\Database\Eloquent\Collection;

class ContractorService extends BaseService implements ContractorServiceInterface
{
    /**
     * @var ContractorRepository
     */
    protected RepositoryInterface $repository;


    protected function getRepository(): string
    {
        return ContractorRepository::class;
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function getById(int $value): Contractor|null
    {
        $this->repository->getById($value);
    }
}
