<?php

declare(strict_types=1);

namespace Common\Database\Factory\Interfaces;

interface FactoryInterface
{
    public function make(?array $data = null);

    public function create(?array $data = null);

    public function count(int $value): FactoryInterface;
}
