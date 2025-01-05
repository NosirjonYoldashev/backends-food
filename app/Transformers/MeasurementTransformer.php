<?php

namespace App\Transformers;

use App\Models\Measurement;
use League\Fractal\TransformerAbstract;

class MeasurementTransformer extends TransformerAbstract
{
    /**
     * Преобразовать сущность Supplier.
     *
     * @param Measurement $model
     * @return array
     */
    public function transform(Measurement $model): array
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
        ];
    }


}
