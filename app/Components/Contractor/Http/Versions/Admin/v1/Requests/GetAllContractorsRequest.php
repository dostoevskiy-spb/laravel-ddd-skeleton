<?php

declare(strict_types=1);

namespace Components\Contractor\Http\Versions\Admin\v1\Requests;

use Common\Http\Requests\AbstractAuthorizedRequest;
use Components\Contractor\Enums\ContractorStatusEnum;
use Components\Contractor\Enums\ContractorTypeEnum;
use Illuminate\Validation\Rule;

class GetAllContractorsRequest extends AbstractAuthorizedRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'max:64',
            ],
            'address' => [
                'string',
                'max:64',
            ],
            'code' => [
                'string',
                'max:64',
            ],
            'inn' => [
                'string',
                'max:64',
            ],
            'ogrn' => [
                'string',
                'max:64',
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
