<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Supplier extends Model
{



    use SoftDeletes;

    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'status',
        'slug'
    ];

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function (self $model) {
            $model->slug = Str::slug($model->name);
            $model->status = StatusEnum::ACTIVE;
            $model->balance = 0.0;
        });

        static::updating(static function (self $model) {
            $model->slug = Str::slug($model->name);
        });

    }
}
