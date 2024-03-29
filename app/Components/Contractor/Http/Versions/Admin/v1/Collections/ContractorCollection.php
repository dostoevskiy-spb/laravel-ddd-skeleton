<?php

declare(strict_types=1);

namespace Components\Contractor\Http\Versions\Admin\v1\Collections;

use Components\Contractor\Http\Versions\Admin\v1\Resources\ContractorResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class ContractorCollection extends ResourceCollection
{
    public $collects = ContractorResource::class;

    /**
     * @param null $request
     */
    public function toArray($request): Collection
    {
        return $this->collection;
    }
}
