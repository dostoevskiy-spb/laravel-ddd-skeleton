<?php

declare(strict_types=1);

namespace Common\Presenters;

use Illuminate\Http\JsonResponse;

abstract class SimplePresenter
{
    public function present(): JsonResponse
    {
        return response()->json($this->getPresentationData());
    }

    /**
     * Response structure
     *
     * @return array
     */
    abstract protected function getPresentationData(): array;
}
