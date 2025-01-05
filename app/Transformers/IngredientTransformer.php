<?php

namespace App\Transformers;

use App\Models\Ingredient;
use League\Fractal\TransformerAbstract;

class IngredientTransformer extends TransformerAbstract
{
    /**
     * Преобразовать сущность Supplier.
     *
     * @param Ingredient $model
     * @return array
     */
    public function transform(Ingredient $model): array
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'measurement_id' => $model->measurement_id,
            'quantity' => $model->quantity,
            'price' => $model->price,
            'expiration_date' => $model->expiration_date,
            'description' => $model->description
        ];
    }


}
