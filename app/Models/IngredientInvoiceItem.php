<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IngredientInvoiceItem extends Model
{
    protected $fillable = [
        'price',
        'arrival_price',
        'ingredient_id',
        'quantity',
        'ingredient_invoice_id',
        'date_expire'
    ];

    public function ingredinet(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }


    public function ingredient_invoice(): BelongsTo
    {
        return $this->belongsTo(IngredientInvoice::class);
    }
}
