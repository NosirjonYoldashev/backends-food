<?php

namespace App\Transformers;

use App\Models\StockMovement;
use League\Fractal\TransformerAbstract;

class StockMovementTransformer extends TransformerAbstract
{
    /**
     * Преобразовать сущность Supplier.
     *
     * @param StockMovement $model
     * @return array
     */
    public function transform(StockMovement $model): array
    {
        return [
            'id' => (int) $model->id,
            'ingredient_id' => $model->ingredient_id,
            'type' => $model->type->StockMovementType(),
            'quantity' => $model->quantity,
            'description' => $model->description,
        ];
    }


}
