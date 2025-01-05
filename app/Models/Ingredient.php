<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'ingredients';

    protected $fillable = [
        'measurement_id',
        'name',
        'quantity',
        'price',
        'expiration_date',
        'description',
    ];

    public function measurement()
    {
        return $this->belongsTo(Measurement::class);
    }

    public function StockMovement()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function ingredients_invoice_item()
    {
        return $this->hasMany(IngredientInvoiceItem::class);
    }
}
