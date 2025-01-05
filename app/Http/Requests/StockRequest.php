<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
        $stock = $this->route('stocks');

        return match ($this->route()?->getName()){
            'stocks.store' => [
                'ingredient_id' => 'required|exists:ingredients,id',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0.01',
                'user_id' => 'nullable|exists:users,id',
            ],
            'stocks.update' => [
                'ingredient_id' => 'required|exists:ingredients,id' . $stock->id,
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0.01',
                'user_id' => 'nullable|exists:users,id',
            ],
            default => []
        };
    }
}
