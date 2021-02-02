<?php

declare(strict_types=1);

namespace Common\Presenters;

use Common\Presenters\Interfaces\PresenterInterface;
use Illuminate\Http\JsonResponse;

abstract class JsonPresenter implements PresenterInterface
{
    public function present(): JsonResponse
    {
        return response()->json($this->getPresentationData());
    }

    abstract protected function getPresentationData(): array;
}
