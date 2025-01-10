<?php

namespace App\Models;

use App\Enums\InvoiceEnum;
    use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class IngredientInvoice extends Model
{

    use SoftDeletes;

    protected $casts = [
        'status' => InvoiceEnum::class,
        'total_amount' => 'float'
    ];

    protected $table = 'ingredient_invoices';

    protected $fillable = [
        'user_id',
        'total_amount',
        'comment',
        'status',
    ];






    public function items(): HasMany
    {
        return $this->hasMany(IngredientInvoiceItem::class, 'ingredient_invoice_id', 'id');
    }



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
