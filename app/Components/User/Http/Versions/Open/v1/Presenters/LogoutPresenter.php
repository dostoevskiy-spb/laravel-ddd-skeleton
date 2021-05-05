<?php

namespace Components\User\Http\Versions\Open\v1\Presenters;

use Common\Presenters\CollectionPresenter;

class LogoutPresenter extends CollectionPresenter
{
    protected function getPresentationData(): array
    {
        return [
            'message' => 'Successfully logged out'
        ];
    }
}
