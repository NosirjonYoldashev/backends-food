<?php

namespace App\Transformers;

use App\Models\IngredientInvoiceItem;
use League\Fractal\TransformerAbstract;

class IngredientInvoiceItemTransformer extends TransformerAbstract
{
    /**
     * Преобразовать сущность Supplier.
     *
     * @param IngredientInvoiceItem $model
     * @return array
     */
    public function transform(IngredientInvoiceItem $model): array
    {
        return [
            'id' => (int) $model->id,
            'invoice_id' => $model->invoice_id,
            'ingredient_id' => $model->ingredient_id,
            'quantity' => $model->quantity,
            'price' => $model->price
        ];
    }


}
