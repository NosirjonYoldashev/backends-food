<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeasurementRequest;
use App\Models\Measurement;
use App\Services\MeasurementService;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MeasurementController extends ApiController
{

    public function __construct(readonly protected MeasurementService $service ){}

    public function index(): JsonResponse
    {
        return $this->successResponse($this->service->all());
    }

    public function show(Measurement $measurement): JsonResponse
    {
        return $this->successResponse($this->service->show($measurement));
    }

    /**
     * @throws ValidatorException
     */
    public function store(MeasurementRequest $request): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->create($request->validated()), Response::HTTP_CREATED);
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @throws ValidatorException
     */
    public function update(MeasurementRequest $request, Measurement $measurement): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->update($measurement,$request->validated()));
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function destroy(Measurement $measurement): JsonResponse
    {
        if($this->service->delete($measurement)){
            return $this->successResponse([],Response::HTTP_NO_CONTENT);
        }

        return $this->errorResponse('No deleting',500);

    }



}
