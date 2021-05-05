<?php

declare(strict_types=1);

namespace Components\User\Http\Versions\Open\v1\Presenters;

use Common\Presenters\SimplePresenter;

class TokenPresenter extends SimplePresenter
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
