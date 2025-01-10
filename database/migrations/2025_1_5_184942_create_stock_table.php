<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredient_id')->constrained('ingredients')->onDelete('restrict');
            $table->decimal('arrival_price',15)->default(0.00);
            $table->decimal('price',15)->default(0.00);
            $table->unsignedInteger('quantity')->default(0);
            $table->dateTime('date_expire');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['ingredient_id', 'quantity']);
            $table->index(['ingredient_id', 'date_expire']);

            $table->unique(['ingredient_id','date_expire'], 'stock_unique');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
