<?php

namespace Common\Enums;

use InvalidArgumentException;

abstract class AbstractEnum
{
    protected static function getEnum(): array
    {
        $reflection = new \ReflectionClass(static::class);
        return array_values($reflection->getConstants());
    }

    public static function getKey(string $value)
    {
        if (static::isValueExist($value) === false) {
            throw new InvalidArgumentException("Value '$value' not found");
        }

        return array_search($value, static::getEnum());
    }

    public static function getValue(string $key)
    {
        if (static::isKeyExist($key) === false) {
            throw new InvalidArgumentException("Value '$key' not found");
        }

        return static::getEnum()[$key];
    }

    public static function getList(): array
    {
        return static::getEnum();
    }

    public static function getKeys(): array
    {
        return array_keys(static::getEnum());
    }

    public static function isKeyExist(string $key): bool
    {
        return (bool) static::getEnum()[$key];
    }

    public static function isValueExist($value): bool
    {
        return array_search($value, static::getEnum(), true);
    }

    public static function isExistInList(int $key): bool
    {
        return isset(static::getEnum()[$key]);
    }
}
