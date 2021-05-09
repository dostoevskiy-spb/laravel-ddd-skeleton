<?php

declare(strict_types=1);

namespace Components\Contractor\Http\Versions\Admin\v1\Controllers;

use Common\Controllers\Controller;
use Components\Contractor\Http\Versions\Admin\v1\Collections\ContractorCollection;
use Components\Contractor\Http\Versions\Admin\v1\Requests\CreateContractorRequest;
use Components\Contractor\Http\Versions\Admin\v1\Requests\DeleteContractorRequest;
use Components\Contractor\Http\Versions\Admin\v1\Requests\GetContractorRequest;
use Components\Contractor\Http\Versions\Admin\v1\Requests\UpdateContractorRequest;
use Components\Contractor\Http\Versions\Admin\v1\Resources\ContractorResource;
use Components\Contractor\Repositories\ContractorRepository;
use Components\Contractor\Services\ContractorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ContractorController extends Controller
{
    protected ContractorService $service;

    /**
     * UserController constructor.
     *
     * @param ContractorService|ContractorRepository $service
     */
    public function __construct(ContractorRepository|ContractorService $service)
    {
        $this->middleware('auth');

        $this->service = $service;
    }


    /**
     * Get all contractors
     *
     * @param GetContractorRequest $request
     * @param int                  $contractorId
     *
     * @return ContractorResource
     */
    public function get(GetContractorRequest $request, int $contractorId): ContractorResource
    {
        return new ContractorResource($this->service->getById($contractorId));
    }

    /**
     * Get all contractors
     *
     * @return ContractorCollection
     */
    public function list(): ContractorCollection
    {
        return new ContractorCollection($this->service->getAll());
    }

    /**
     * Get all contractors
     *
     * @param UpdateContractorRequest $request
     * @param int                     $contractorId
     *
     * @return ContractorResource
     */
    public function update(UpdateContractorRequest $request, int $contractorId): ContractorResource
    {
        $data = $request->only(
            [
                'name',
                'code',
                'address',
                'inn',
                'ogrn',
                'status_id',
                'type_id',
            ]
        );
        $contractor = $this->service->getById($contractorId);

        return new ContractorResource($this->service->update($contractor, $data));
    }

    /**
     * Get all contractors
     *
     * @param CreateContractorRequest $request
     *
     * @return ContractorResource
     */
    public function create(CreateContractorRequest $request): ContractorResource
    {
        $data = $request->only(
            [
                'name',
                'code',
                'address',
                'inn',
                'ogrn',
                'status_id',
                'type_id',
            ]
        );

        return new ContractorResource($this->service->create($data));
    }

    /**
     * Get all contractors
     *
     * @param DeleteContractorRequest $request
     * @param int                  $contractorId
     *
     * @return JsonResponse
     */
    public function delete(DeleteContractorRequest $request, int $contractorId): JsonResponse
    {
        return response()->json(
            [
                'status'  => $this->service->delete($contractorId),
                'message' => 'Success',
            ],
            Response::HTTP_OK
        );
    }
}
