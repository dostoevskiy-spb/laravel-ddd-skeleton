<?php

declare(strict_types=1);

namespace Components\Contractor\Http\Versions\Admin\v1\Requests;

use Common\Http\Requests\AbstractAuthorizedRequest;
use Components\Contractor\Enums\ContractorStatusEnum;
use Components\Contractor\Enums\ContractorTypeEnum;
use Illuminate\Validation\Rule;

class UpdateContractorRequest extends AbstractAuthorizedRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'max:64',
                'min:3',
            ],
            'code' => [
                'string',
                'min:2',
                'max:5',
            ],
            'address' => [
                'bail',
                'required',
                'min:10',
                'string',
                'max:500',
            ],
            'inn' => [
                'string',
                'length:10',
            ],
            'ogrn' => [
                'string',
                'length:11',
            ],
            'status_id' => [
                'integer',
                Rule::in(ContractorStatusEnum::getList()),
            ],
            'type_id' => [
                'integer',
                Rule::in(ContractorTypeEnum::getList()),
            ],
        ];
    }
}
