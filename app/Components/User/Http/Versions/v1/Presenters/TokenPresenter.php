<?php

declare(strict_types=1);

namespace Components\User\Http\Versions\v1\Presenters;

use Common\Presenters\JsonPresenter;

class TokenPresenter extends JsonPresenter
{
    /**
     * @var string
     */
    protected $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    protected function getPresentationData(): array
    {
        return [
            'message' => 'Authentication success.',
            'data' => [
                'token' => $this->token,
            ],
        ];
    }
}
