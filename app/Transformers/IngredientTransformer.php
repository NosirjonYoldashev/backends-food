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
    public function transform(Ingredient $ingredient): array
    {
        return [
            'id' => (int) $ingredient->id,
            'name' => $ingredient->name,
            'measurement_id' => $ingredient->measurement_id,
            'expiration_date' => $ingredient->expiration_date,
            'description' => $ingredient->description
        ];
    }


}
