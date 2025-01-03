<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
        $supplier = $this->route('supplier');

        return match ($this->route()?->getName()){
            'suppliers.store' => [
                'name' => 'required|string|max:150|unique:suppliers',
                'phone_number' => 'required|nullable|string|max:32',
                'address' => 'required|nullable|string|max:255',
            ],
            'suppliers.update' => [
                'name' => 'required|string|max:150|unique:suppliers,name,' . $supplier->id,
                'phone_number' => 'required|nullable|string|max:32',
                'address' => 'required|nullable|string|max:255',
            ],
            default => []
        };
    }
}
