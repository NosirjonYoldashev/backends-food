<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientInvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'ingredient_id',
        'quantity',
        'price',
    ];

    // Aloqalar
    public function invoice()
    {
        return $this->belongsTo(IngredientInvoice::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
