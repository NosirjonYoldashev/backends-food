<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientInvoiceRequest;
use App\Models\IngredientInvoice;
use App\Services\IngredientInvoiceService;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class IngredientInvoiceController extends ApiController
{

    public function __construct(readonly protected IngredientInvoiceService $service ){}

    public function index(): JsonResponse
    {
        return $this->successResponse($this->service->all());
    }

    public function show(IngredientInvoice $ingredient_invoices): JsonResponse
    {
        return $this->successResponse($this->service->show($ingredient_invoices));
    }

    /**
     * @throws ValidatorException
     */
    public function store(IngredientInvoiceRequest $request): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->create($request->validated()), Response::HTTP_CREATED);
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @throws ValidatorException
     */
    public function update(IngredientInvoiceRequest $request, IngredientInvoice $ingredient_invoices): JsonResponse
    {
        if($request->validated()){
            return $this->successResponse($this->service->update($ingredient_invoices,$request->validated()));
        }

        return $this->errorResponse('Invalid data', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function destroy(IngredientInvoice $ingredient_invoices): JsonResponse
    {
        if($this->service->delete($ingredient_invoices)){
            return $this->successResponse([],Response::HTTP_NO_CONTENT);
        }

        return $this->errorResponse('No deleting',500);

    }

}
