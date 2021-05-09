<?php

declare(strict_types=1);

namespace Common\Http\Requests;

abstract class AbstractAuthorizedRequest extends AbstractRequest
{

    public function authorize(): bool
    {
        return true;
    }
}
