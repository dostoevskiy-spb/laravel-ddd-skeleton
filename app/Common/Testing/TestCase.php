<?php

declare(strict_types=1);

namespace Common\Testing;

use Components\User\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var Generator
     */
    protected $faker;

    /**
     * Request paras
     *
     * @var array
     */
    protected $requestData = [];

    /**
     * @var array
     */
    protected $headers = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('cache:clear');
        $this->artisan('components:wipe -f');
        $this->artisan('components:init');

        $this->faker = Factory::create();
    }

    protected function getContent(TestResponse $response)
    {
        return json_decode($response->getContent());
    }

    public function actingAs(User $user): void
    {
        $token = auth()->login($this->user);

        $this->headers['Authorization'] = "Bearer ${token}";
    }
}
