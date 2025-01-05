<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockMovementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $stock_movements = $this->route('stock_movements');

        return match ($this->route()?->getName()){
            'stock_movements.store' => [
                'ingredient_id' => 'required|exists:ingredients,id',
                'quantity' => 'required|integer|min:1',
                'description' => 'nullable|string',
            ],
            'stock_movements.update' => [
                'ingredient_id' => 'required|exists:ingredients,id' . $stock_movements->id,
                'quantity' => 'required|integer|min:1',
                'description' => 'nullable|string',
            ],
            default => []
        };
    }

    public function messages(): array
    {
        return [
            'ingredient_id.required' => 'Ingredient tanlash shart.',
            'ingredient_id.exists' => 'Tanlangan ingredient mavjud emas.',
            'type.required' => 'Tur tanlash shart.',
            'type.in' => 'Noto‘g‘ri tur qiymati.',
            'quantity.required' => 'Miqdor kiritilishi shart.',
            'quantity.integer' => 'Miqdor butun son bo‘lishi kerak.',
            'quantity.min' => 'Miqdor kamida 1 bo‘lishi kerak.',
            'description.string' => 'Tavsif matn bo‘lishi kerak.',
        ];
    }

}
