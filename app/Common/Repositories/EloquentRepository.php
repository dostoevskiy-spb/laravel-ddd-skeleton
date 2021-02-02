<?php

declare(strict_types=1);

namespace Common\Repositories;

use Common\Models\BaseModel;
use Common\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

abstract class EloquentRepository implements RepositoryInterface
{
    /**
     * @var BaseModel
     */
    protected $model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->model = $this->getModel();
    }

    public function __toString(): string
    {
        return class_basename(static::class);
    }

    public function getQuery(): Builder
    {
        return $this->model::query();
    }

    public function getFirst(array $where)
    {
        return $this->model::where($where)->first();
    }

    public function getById(int $id)
    {
        return $this->getFirst(['id' => $id]);
    }

    public function get(array $where): ?Collection
    {
        return $this->model::where($where)->get();
    }

    public function getAll(): ?Collection
    {
        return $this->model::all();
    }

    public function create(array $data): BaseModel
    {
        $newRecord = new $this->model();

        $newRecord->fill($data);
        $newRecord->save();

        return $newRecord;
    }

    public function update(BaseModel $model, array $data): BaseModel
    {
        if (get_class($model) !== $this->model) {
            throw new ModelNotFoundException('Wrong model class');
        }

        $model->fill($data);

        $model->save();

        return $model;
    }

    public function delete(int $id): int
    {
        return $this->model::destroy($id);
    }

    public function exist(array $where): bool
    {
        return $this->model::where($where)->exists();
    }

    public function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    public function rollback(): void
    {
        DB::rollBack();
    }

    public function commit(): void
    {
        DB::commit();
    }

    abstract protected function getModel(): string;
}
