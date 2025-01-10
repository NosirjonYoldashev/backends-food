<?php

namespace App\Http\Controllers;

use App\Enums\InvoiceEnum;
use App\Http\Requests\IngredientInvoiceRequest;
use App\Http\Requests\IngredientRequest;
use App\Models\IngredientInvoice;
use App\Services\IngredientInvoiceService;
use Illuminate\Http\Request;
use RuntimeException;
use Illuminate\Http\JsonResponse;
use Prettus\Validator\Exceptions\ValidatorException;

class IngredientInvoiceController extends ApiController
{

    public function __construct(readonly protected IngredientInvoiceService $service)
    {
    }


    public function index()
    {
        return $this->successResponse($this->service->all());
    }

    public function show(IngredientInvoice $IngredientInvoice): JsonResponse
    {
        return $this->successResponse($this->service->show($IngredientInvoice));
    }

    /**
     * @throws ValidatorException
     */
    public function store(IngredientInvoiceRequest $request): JsonResponse
    {
        return $this->successResponse($this->service->create($request->validated()));
    }

    public function reject(IngredientInvoice $IngredientInvoice): JsonResponse
    {
        if($IngredientInvoice->status !== InvoiceEnum::DRAFT){
            throw new RuntimeException('Invoice cannot be rejected');
        }

        return $this->successResponse($this->service->reject($IngredientInvoice));
    }

    public function confirm(IngredientInvoiceRequest $request, IngredientInvoice $ingredientInvoice): JsonResponse
    {
        if ($ingredientInvoice->status !== InvoiceEnum::DRAFT) {
            throw new RuntimeException('Invoice cannot be confirmed');
        }

        $items = $request->input('items');

        // Ikkita argument uzatish: $ingredientInvoice va $request
        return $this->successResponse($this->service->confirm($ingredientInvoice, $items));
    }

    public function update(IngredientInvoice $IngredientInvoice, IngredientInvoiceRequest $request): JsonResponse
    {
        if($IngredientInvoice->status !== InvoiceEnum::DRAFT){
            throw new RuntimeException('Invoice cannot be updated');
        }
        return $this->successResponse($this->service->update($IngredientInvoice,$request->validated()));

    }
}
