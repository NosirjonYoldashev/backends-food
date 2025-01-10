<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredientInvoiceRequest extends FormRequest
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
        return  match ($this->route()?->getName()){
            'ingredient_invoices.store',
            'ingredient_invoices.update' => [
                'items' => 'required|array|min:1',
                'items.*.ingredient_id' => 'required|exists:ingredients,id',
                'items.*.quantity' => 'required|numeric|min:1',
                'items.*.price' => 'required|numeric|min:1',
                'items.*.arrival_price' => 'required|numeric|min:1',
                'items.*.date_expire' => 'required|date|date_format:d.m.Y',
            ],

            default => []
        };
    }
}
