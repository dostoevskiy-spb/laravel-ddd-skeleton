<?php

namespace Components\User\Http\Versions\v1\Presenters;

use Common\Presenters\JsonPresenter;

class LogoutPresenter extends JsonPresenter
{
    protected function getPresentationData(): array
    {
        return [
            'message' => 'Successfully logged out'
        ];
    }
}
