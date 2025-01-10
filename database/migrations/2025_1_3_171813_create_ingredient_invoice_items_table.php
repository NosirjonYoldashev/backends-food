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
        Schema::create('ingredient_invoice_items', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredient_id')->constrained('ingredients')->onDelete('restrict');
            $table->unsignedInteger('quantity');
            $table->decimal('arrival_price',15)->default(0.00);
            $table->decimal('price',15)->default(0.00);
            $table->foreignId('ingredient_invoice_id')->constrained('ingredient_invoices')->onDelete('restrict');
            $table->date('date_expire');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_invoice_items');
    }
};
