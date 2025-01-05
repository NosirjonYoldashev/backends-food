<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'ingredient_id',
        'quantity',
        'price',
        'user_id',
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
