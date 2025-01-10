<?php

namespace App\Transformers\IngredientInvoice;

use App\Models\IngredientInvoice;
use App\Transformers\IngredientTransformer;
use League\Fractal\TransformerAbstract;

class IngredientInvoiceAllTransformer extends TransformerAbstract
{
    public function transform(IngredientInvoice $stockInvoice): array
    {
        return [
            'id' => (int) $stockInvoice->id,
            'user' => $stockInvoice->user->only('id', 'name'),
            'total_amount' =>  $stockInvoice->total_amount,
            'status' => [
                'name' => $stockInvoice->status,
                'translate' => $stockInvoice->status->translate()
            ],

            'created_at' => $stockInvoice->created_at?->toISOString(),
            'updated_at' => $stockInvoice->updated_at?->toISOString(),
            'deleted_at' => $stockInvoice->deleted_at?->toISOString(),

        ];
    }

}
