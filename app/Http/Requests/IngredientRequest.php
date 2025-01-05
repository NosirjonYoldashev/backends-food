<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngredientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'measurement_id' => 'required|exists:measurements,id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0.01',
            'price' => 'required|numeric|min:0.01',
            'expiration_date' => 'nullable|date|after_or_equal:today',
            'description' => 'nullable|string',
        ];
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

