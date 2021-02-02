<?php

namespace Common\Repositories\Interfaces;

use Common\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    public function getQuery(): Builder;

    public function getFirst(array $where);

    public function getById(int $id);

    public function get(array $where): ?Collection;

    public function getAll(): ?Collection;

    public function create(array $data): BaseModel;

    public function update(BaseModel $model, array $data): BaseModel;

    public function delete(int $id): int;

    public function exist(array $where): bool;

    public function beginTransaction(): void;

    public function rollback(): void;

    public function commit(): void;
}
