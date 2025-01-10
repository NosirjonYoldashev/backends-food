<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\JsonResponse;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\Response;

class SupplierController extends ApiController
{

    public function __construct(readonly protected SupplierService $service ){}

    public function index(): JsonResponse
    {
        return $this->successResponse($this->service->all());
    }

    public function show(Supplier $supplier): JsonResponse
    {
        return $this->successResponse($this->service->show($supplier));
    }

    /**
     * @throws ValidatorException
     */
    public function store(SupplierRequest $request): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->create($request->validated()), Response::HTTP_CREATED);
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @throws ValidatorException
     */
    public function update(SupplierRequest $request, Supplier $supplier): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->update($supplier,$request->validated()));
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function destroy(Supplier $supplier): JsonResponse
    {
        if($this->service->delete($supplier)){
            return $this->successResponse([],Response::HTTP_NO_CONTENT);
        }

        return $this->errorResponse('No deleting',500);

    }

    public function toggleStatus(Supplier $supplier): JsonResponse
    {
        $supplier->status = $supplier->status === StatusEnum::ACTIVE ? StatusEnum::INACTIVE : StatusEnum::ACTIVE;
        $supplier->save();

        return $this->successResponse($this->service->show($supplier));
    }

}
