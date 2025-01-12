<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $ingredient = $this->route('ingredient');

        return match ($this->route()?->getName()) {
            'ingredients.store' => [
                'measurement_id' => 'required|exists:measurements,id',
                'name' => 'required|string|max:255',
                'quantity' => 'required|numeric|min:0.01',
                'price' => 'required|numeric|min:0.01',
                'expiration_date' => 'nullable|date|after_or_equal:today',
                'description' => 'nullable|string',
            ],
            'ingredients.update' => [
                'measurement_id' => 'required|exists:measurements,id',
                'name' => 'required|string|max:255' . $ingredient->id,
                'quantity' => 'required|numeric|min:0.01',
                'price' => 'required|numeric|min:0.01',
                'expiration_date' => 'nullable|date|after_or_equal:today',
                'description' => 'nullable|string',

            ],
            default => []
        };
    }

    public function messages()
    {
        return [
            'measurement_id.required' => 'O‘lchov birligi talab qilinadi.',
            'measurement_id.exists' => 'Tanlangan o‘lchov birligi noto‘g‘ri.',
            'name.required' => 'Nomini kiritish talab qilinadi.',
            'quantity.required' => 'Miqdori kiritish talab qilinadi.',
            'price.required' => 'Narxni kiritish talab qilinadi.',
            'expiration_date.after_or_equal' => 'Yaroqlilik muddati bugundan keyin bo‘lishi kerak.',
        ];
    }
}

