<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockMovementRequest;
use App\Models\StockMovement;
use App\Services\StockMovementService;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StockMovementController extends ApiController
{

    public function __construct(readonly protected StockMovementService $service ){}

    public function index(): JsonResponse
    {
        return $this->successResponse($this->service->all());
    }

    public function show(StockMovement $stock_movement): JsonResponse
    {
        return $this->successResponse($this->service->show($stock_movement));
    }

    /**
     * @throws ValidatorException
     */
    public function store(StockMovementRequest $request): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->create($request->validated()), Response::HTTP_CREATED);
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @throws ValidatorException
     */
    public function update(StockMovementRequest $request, StockMovement $stock_movement): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->update($stock_movement,$request->validated()));
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function destroy(StockMovement $stock_movement): JsonResponse
    {
        if($this->service->delete($stock_movement)){
            return $this->successResponse([],Response::HTTP_NO_CONTENT);
        }

        return $this->errorResponse('No deleting',500);

    }



}
