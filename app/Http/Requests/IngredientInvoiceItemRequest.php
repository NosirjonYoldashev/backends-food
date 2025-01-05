<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredientInvoiceItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $ingredient_invoice_items = $this->route('ingredient_invoice_items');

        return match ($this->route()?->getName()){
            'ingredient_invoice_items.store' => [
                'invoice_id' => 'required|exists:ingredient_invoices,id',
                'ingredient_id' => 'required|exists:ingredients,id',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
            ],
            'ingredient_invoice_items.update' => [
                'invoice_id' => 'required|exists:ingredient_invoices,id' . $ingredient_invoice_items->id,
                'ingredient_id' => 'required|exists:ingredients,id',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
            ],
            default => []
        };
    }
}
