<?php

declare(strict_types=1);

namespace Components\Contractor\Http\Versions\Admin\v1\Requests;

use Common\Http\Requests\AbstractAuthorizedRequest;
use Illuminate\Support\Facades\Request;

class DeleteContractorRequest extends AbstractAuthorizedRequest
{
    public function prepareForValidation(): void
    {
        $this->request->add([
            'id' => Request::route('id'),
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => [
                'bail',
                'required',
                'integer',
                'exists:contractors'
            ],
        ];
    }
}
