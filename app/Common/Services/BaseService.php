<?php

declare(strict_types=1);

namespace Common\Services;

use Common\Repositories\Interfaces\RepositoryInterface;
use Components\User\Facades\Auth;
use Components\User\User;
use Exception;

abstract class BaseService
{
    /**
     * @var RepositoryInterface
     */
    protected RepositoryInterface $repository;
    protected User $user;

    public function __construct()
    {
        $repositoryClass = $this->getRepository();

        $this->repository = new $repositoryClass();
        $this->user = Auth::user();
    }

    public function __call($name, $arguments)
    {
        if (!$this->isMethodExist($name)) {
            if ($this->isMethodExistInRepository($name)) {
                return $this->repository->{$name}(...$arguments);
            }

            throw new Exception('Method not found in ', $this->repository, $name);
        }

        return self::$name(...$arguments);
    }

    abstract protected function getRepository(): string;

    protected function isMethodExist(string $name): bool
    {
        return method_exists(self::class, $name);
    }

    protected function isMethodExistInRepository(string $name): bool
    {
        return method_exists($this->repository, $name);
    }
}
