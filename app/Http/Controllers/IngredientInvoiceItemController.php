<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientInvoiceItemRequest;
use App\Models\IngredientInvoiceItem;
use App\Services\IngredientInvoiceItemService;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IngredientInvoiceItemController extends ApiController
{

    public function __construct(readonly protected IngredientInvoiceItemService $service ){}

    public function index(): JsonResponse
    {
        return $this->successResponse($this->service->all());
    }

    public function show(IngredientInvoiceItem $ingredient_invoices): JsonResponse
    {
        return $this->successResponse($this->service->show($ingredient_invoices));
    }

    /**
     * @throws ValidatorException
     */
    public function store(IngredientInvoiceItemRequest $request): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->create($request->validated()), Response::HTTP_CREATED);
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @throws ValidatorException
     */
    public function update(IngredientInvoiceItemRequest $request, IngredientInvoiceItem $ingredient_invoices): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->update($ingredient_invoices,$request->validated()));
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function destroy(IngredientInvoiceItem $ingredient_invoices): JsonResponse
    {
        if($this->service->delete($ingredient_invoices)){
            return $this->successResponse([],Response::HTTP_NO_CONTENT);
        }

        return $this->errorResponse('No deleting',500);

    }

}
