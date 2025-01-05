<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Stock;
use App\Services\StockService;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StockController extends ApiController
{

    public function __construct(readonly protected StockService $service ){}

    public function index(): JsonResponse
    {
        return $this->successResponse($this->service->all());
    }

    public function show(Stock $stock): JsonResponse
    {
        return $this->successResponse($this->service->show($stock));
    }

    /**
     * @throws ValidatorException
     */
    public function store(StockRequest $request): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->create($request->validated()), Response::HTTP_CREATED);
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @throws ValidatorException
     */
    public function update(StockRequest $request, Stock $stock): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->update($stock,$request->validated()));
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function destroy(Stock $stock): JsonResponse
    {
        if($this->service->delete($stock)){
            return $this->successResponse([],Response::HTTP_NO_CONTENT);
        }

        return $this->errorResponse('No deleting',500);

    }


}
