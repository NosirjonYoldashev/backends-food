<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Supplier;

class SupplierTransformer extends TransformerAbstract
{
    /**
     * Преобразовать сущность Supplier.
     *
     * @param Supplier $model
     * @return array
     */
    public function transform(Supplier $model): array
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'slug' => $model->slug,
            'phone_number' => $model->phone_number,
            'address' => $model->address,
            'status' => $model->status->translate(),
            'balance' => $model->balance
        ];
    }


}
