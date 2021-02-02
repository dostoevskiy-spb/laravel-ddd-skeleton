<?php

declare(strict_types=1);

namespace Common\Repositories;

use Illuminate\Support\Facades\Redis;

class RedisRepository
{
    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var Redis
     */
    protected $redis;

    /**
     * @var int
     */
    protected $expirationTime = 86400;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    public function set(string $key, string $value): void
    {
        $this->redis->set("{$this->prefix}{$key}", $value, 'EX', $this->expirationTime);
    }

    public function get(string $key): ?string
    {
        return $this->redis->get("{$this->prefix}{$key}");
    }

    public function setPrefix(string $prefix): void
    {
        $this->prefix = "{$prefix}:";
    }

    public function delete(string $key)
    {
        return $this->redis->del("{$this->prefix}{$key}");
    }

    public function isExists(string $key, string $value): bool
    {
        return $this->get($key) === $value;
    }

    public function setExpirationTime(int $seconds): void
    {
        $this->expirationTime = $seconds;
    }
}
