<?php

declare(strict_types=1);

namespace Components\User\Versions\v1\Tests\Feature;

use Symfony\Component\HttpFoundation\Response;

class AuthenticationTest extends TestBase
{
    public function testAuthenticationSuccess(): void
    {
        $response = $this->json('POST', route('user.login', [
            'email' => self::EMAIL,
            'password' => self::PASSWORD,
        ]));

        $response->assertOk();
        $response->assertJsonStructure([
            'message',
            'data' => [
                'token',
            ],
        ]);
    }

    public function testWrongCredentials(): void
    {
        $this->requestData['password'] = self::PASSWORD . 'wrong';

        $response = $this->json('POST', route('user.login', $this->requestData));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure([
            'code',
            'message',
        ]);
    }
}
