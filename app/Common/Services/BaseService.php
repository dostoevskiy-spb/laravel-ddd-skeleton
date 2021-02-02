<?php

declare(strict_types=1);

namespace Common\Services;

use Common\Repositories\Interfaces\RepositoryInterface;
use Exception;

abstract class BaseService
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    public function __construct()
    {
        $repositoryClass = $this->getRepository();

        $this->repository = new $repositoryClass();
    }

    public function __call($name, $arguments)
    {
        if ($this->isMethodExist($name) === false) {
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
