<?php

declare(strict_types=1);

namespace Components\User\Http\Versions\v1\Tests\Feature;

use Symfony\Component\HttpFoundation\Response;

class AuthorizationTest extends TestBase
{
    public function testAuthorizationSuccess(): void
    {
        $response = $this->json('GET', route('user.current'), $this->requestData);

        $response->assertOk();
        $response->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'email',
            ],
        ]);
    }

    public function testWrongToken(): void
    {
        $this->unAuthorize();

        $response = $this->json('GET', route('user.current'), $this->requestData);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertJsonStructure([
            'code',
            'message',
        ]);
    }
}
