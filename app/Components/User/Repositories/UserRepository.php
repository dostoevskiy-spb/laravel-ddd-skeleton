<?php

declare(strict_types=1);

namespace Components\User\Repositories;

use Common\Models\BaseModel;
use Common\Repositories\EloquentRepository;
use Components\User\Interfaces\UserRepositoryInterface;
use Components\User\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserRepository
 *
 * @method User getFirst(array $where)
 */
class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function getByEmail(string $email): ?User
    {
        return $this->getFirst(['email' => $email]);
    }

    /**
     * @param array $data
     * @return BaseModel|User|Builder
     */
    public function create(array $data): BaseModel
    {
        return User::create($data);
    }

    protected function getModel(): string
    {
        return User::class;
    }
}
