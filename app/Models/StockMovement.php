<?php

namespace App\Models;

use App\Enums\MovementProductType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{

    protected $table = 'stock_movements';

    protected $casts = [
        'type' => MovementProductType::class
    ];

    protected $fillable = [
        'stock_id',
        'user_id',
        'type',
        'quantity',
        'description',
        'invoice_id',
        'purchase_price',
    ];

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(IngredientInvoice::class);
    }
}
