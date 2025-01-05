<?php

namespace App\Transformers;

use App\Models\Stock;
use League\Fractal\TransformerAbstract;

class StockTransformer extends TransformerAbstract
{
    /**
     * Преобразовать сущность Supplier.
     *
     * @param Stock $model
     * @return array
     */
    public function transform(Stock $model): array
    {
        return [
            'id' => (int) $model->id,
            'ingredient_id' => $model->ingredient_id,
            'quantity' => $model->quantity,
            'price' => $model->price,

        ];
    }


}
