<?php

declare(strict_types=1);

namespace Components\Contractor\Http\Versions\Admin\v1\Requests;

use Common\Http\Requests\AbstractAuthorizedRequest;
use Illuminate\Support\Facades\Request;

class GetContractorRequest extends AbstractAuthorizedRequest
{
    public function prepareForValidation(): void
    {
        $this->query->add([
            'id' => Request::route('id'),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [
                'bail',
                'required',
                'integer',
                'exists:contractors',
            ],
        ];
    }
}
