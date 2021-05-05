<?php

declare(strict_types=1);

namespace Components\User\Http\Versions\Admin\v1\Presenters;

use App\Components\User\Enums\UserEntityEnum;
use Common\Presenters\SimplePresenter;
use Components\User\User;

class UserPresenter extends SimplePresenter
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
            'is_admin' => $this->user->entity_id === UserEntityEnum::ID_ADMIN,
            'data' => $this->user,
        ];
    }
}
