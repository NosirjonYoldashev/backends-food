<?php

namespace App\Transformers;

use App\Models\IngredientInvoice;
use League\Fractal\TransformerAbstract;

class IngredientInvoiceTransformer extends TransformerAbstract
{
    /**
     * Преобразовать сущность Supplier.
     *
     * @param IngredientInvoice $model
     * @return array
     */
    public function transform(IngredientInvoice $model): array
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'status' => $model->status->IngredientInvoiceStatus(),
        ];
    }
}
