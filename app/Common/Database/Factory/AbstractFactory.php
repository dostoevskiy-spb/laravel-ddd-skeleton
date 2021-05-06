<?php

declare(strict_types=1);

namespace Common\Database\Factory;

use Common\Database\Factory\Interfaces\FactoryInterface;
use Common\Models\BaseModel;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Collection;

abstract class AbstractFactory implements FactoryInterface
{
    /**
     * Faker instance
     *
     * @var Generator
     */
    protected $faker;

    /**
     * Count of instances
     *
     * @var int
     */
    protected $count = 1;

    /**
     * @var BaseModel|array
     */
    protected $instances;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function count(int $value): FactoryInterface
    {
        $this->count = $value;

        return $this;
    }

    public function generate(int $count): array
    {
        $result = [];
        for($i=1; $i<$count; $i++) {
            $result[] = $this->getFields();
        }

        return $result;
    }

    public function make(?array $data = null)
    {
        $this->prepareInstances($data);

        return $this->getResult();
    }

    public function create(?array $data = null)
    {
        $this->prepareInstances($data);

        $this->saveInstances();

        return $this->getResult();
    }

    protected function getResult()
    {
        if ($this->count > 1) {
            return new Collection($this->instances);
        }

        return $this->instances[0];
    }

    protected function prepareInstances(?array $data = null): void
    {
        $this->createInstances();

        $this->fillInstances($data);
    }

    protected function createInstances(): void
    {
        $model = $this->getModel();

        for ($i = 0; $i < $this->count; $i++) {
            $this->instances[] = new $model();
        }
    }

    protected function fillInstances(?array $data = null): void
    {
        foreach ($this->instances as $instance) {
            $structure = $this->getFields();

            foreach ($structure as $key => $value) {
                $instance->{$key} = $data[$key] ?? $value;
            }
        }
    }

    protected function saveInstances(): void
    {
        foreach ($this->instances as $instance) {
            $instance->save();
        }
    }

    abstract protected function getFields(): array;

    abstract protected function getModel(): string;
}
