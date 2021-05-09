<?php

declare(strict_types=1);

namespace Components\Contractor\Http\Versions\Admin\v1\Requests;

use Common\Http\Requests\AbstractAuthorizedRequest;
use Components\Contractor\Enums\ContractorStatusEnum;
use Components\Contractor\Enums\ContractorTypeEnum;
use Illuminate\Validation\Rule;

class CreateContractorRequest extends AbstractAuthorizedRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'bail',
                'required',
                'string',
                'max:64',
            ],
            'code' => [
                'bail',
                'required',
                'min:8',
                'string',
                'max:64',
            ],
            'address' => [
                'bail',
                'required',
                'min:10',
                'string',
                'max:500',
            ],
            'inn' => [
                'bail',
                'required',
                'string',
                'length:10',
            ],
            'ogrn' => [
                'bail',
                'required',
                'string',
                'length:11',
            ],
            'status_id' => [
                'bail',
                'required',
                'integer',
                Rule::in(ContractorStatusEnum::getList()),
            ],
            'type_id' => [
                'bail',
                'required',
                'integer',
                Rule::in(ContractorTypeEnum::getList()),
            ],
        ];
    }
}
