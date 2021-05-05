<?php

declare(strict_types=1);

namespace Components\User\Http\Versions\v1\Presenters;

use Common\Presenters\JsonPresenter;
use Components\User\User;

class UserPresenter extends JsonPresenter
{
    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    protected function getPresentationData(): array
    {
        return [
            'message' => 'Current authenticated user.',
            'data' => $this->user,
        ];
    }
}
