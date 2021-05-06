<?php

declare(strict_types=1);

namespace Components\Contractor\Http\Versions\Admin\v1\Resources;

use Components\Contractor\Contractor;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractorResource extends JsonResource
{
    /**
     * @param null $request

     * @uses Country::$name_ru
     * @uses Country::$name_en
     *
     * @return array
     */
    public function toArray($request): array
    {
        /** @var Contractor $contractor */
        $contractor = $this->resource;

        return [
            'name' => $contractor->name,
            'type' => $contractor->type,
            'status' => $contractor->status,
            'address' => $contractor->address,
            'inn' => $contractor->inn,
            'ogrn' => $contractor->ogrn,
        ];
    }
}
