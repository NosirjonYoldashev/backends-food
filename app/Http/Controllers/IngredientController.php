<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use App\Models\Ingredient;
use App\Services\IngredientService;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IngredientController extends ApiController
{

    public function __construct(readonly protected IngredientService $service ){}

    public function index(): JsonResponse
    {
        return $this->successResponse($this->service->all());
    }

    public function show(Ingredient $ingredient): JsonResponse
    {
        return $this->successResponse($this->service->show($ingredient));
    }

    /**
     * @throws ValidatorException
     */
    public function store(IngredientRequest $request): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->create($request->validated()), Response::HTTP_CREATED);
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @throws ValidatorException
     */
    public function update(IngredientRequest $request, Ingredient $ingredient): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->update($ingredient,$request->validated()));
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function destroy(Ingredient $ingredient): JsonResponse
    {
        if($this->service->delete($ingredient)){
            return $this->successResponse([],Response::HTTP_NO_CONTENT);
        }

        return $this->errorResponse('No deleting',500);

    }



}
