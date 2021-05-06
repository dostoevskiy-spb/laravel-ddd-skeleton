<?php

declare(strict_types=1);

namespace Components\Contractor\Http\Versions\Admin\v1\Controllers;

use Common\Controllers\Controller;
use Components\Contractor\Http\Versions\Admin\v1\Collections\ContractorCollection;
use Components\Contractor\Services\ContractorService;

class ContractorController extends Controller
{
    protected ContractorService $service;

    /**
     * UserController constructor.
     *
     * @param ContractorService $service
     */
    public function __construct(ContractorService $service)
    {
        $this->middleware('auth');

        $this->service = $service;
    }

    /**
     * Get all contractors
     *
     * @return ContractorCollection
     */
    public function index(): ContractorCollection
    {
        return new ContractorCollection($this->service->getAll());
    }
}
