<?php

use Common\Database\Factory\Interfaces\FactoryInterface;

function init_factory(string $model, array $arguments = []): FactoryInterface
{
    return app($model, ...$arguments);
}
