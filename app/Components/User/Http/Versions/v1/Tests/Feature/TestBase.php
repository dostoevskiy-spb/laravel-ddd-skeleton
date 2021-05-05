<?php

declare(strict_types=1);

namespace Components\User\Http\Versions\v1\Tests\Feature;

use Common\Testing\TestCase;
use Components\User\Traits\Authentication;
use Components\User\Database\Factory\UserFactory;
use Components\User\User;
use Illuminate\Support\Facades\Hash;

class TestBase extends TestCase
{
    use Authentication;

    protected const EMAIL = 'exhum4n@gmail.com';
    protected const PASSWORD = 'qwerty123';

    /**
     * @var User
     */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = init_factory(UserFactory::class)->create([
            'email' => static::EMAIL,
            'password' => Hash::make(static::PASSWORD),
        ]);

        $this->authorize($this->user);
    }
}
