<?php

namespace App\Transformers\IngredientInvoice;

use App\Models\IngredientInvoice;
use League\Fractal\TransformerAbstract;

class IngredientInvoiceTransformer extends TransformerAbstract
{
    public function transform(IngredientInvoice $ingredientInvoice): array
    {
        return [
            'id' => (int) $ingredientInvoice->id,
            'user' => $ingredientInvoice->user->only('id', 'name'),
            'total_amount' =>  $ingredientInvoice->total_amount,
            'status' => [
                'name' => $ingredientInvoice->status,
                'translate' => $ingredientInvoice->status->translate()
            ],
            'items' => $ingredientInvoice->items,
//            'items' => $ingredientInvoice->items->map(function ($item) {
//                return [
//                    'id' => (int) $item->id,
//                    'quantity' => $item->quantity,
//                    'price' => $item->price,
//                    'arrival_price' => $item->arrival_price,
//                    'date_expire' => $item->date_expire,
//                ];
//            })->values()->all(),

            'created_at' => $ingredientInvoice->created_at?->toISOString(),
            'updated_at' => $ingredientInvoice->updated_at?->toISOString(),
            'deleted_at' => $ingredientInvoice->deleted_at?->toISOString(),

        ];
    }

}
