<?php

declare(strict_types=1);

namespace Common\Presenters\Interfaces;

use Illuminate\Http\JsonResponse;

interface PresenterInterface
{
    public function present(): JsonResponse;
}
