<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IngredientInvoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    public function ingredients_invoice_item()
    {
        return $this->hasMany(IngredientInvoiceItem::class);
    }
}
