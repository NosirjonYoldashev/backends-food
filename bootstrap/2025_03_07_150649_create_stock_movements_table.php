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
        Schema::create('stock_movements', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('stock_id')->constrained('stock')->onDelete('restrict');
            $table->foreignId('invoice_id')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->enum('type', ['arrival', 'departure', 'transfer', 'return']);
            $table->decimal('purchase_price', 15);
            $table->integer('quantity');
            $table->text('description')->nullable();

            $table->timestamps();

            $table->index(['invoice_id', 'created_at']);
            $table->index(['stock_id', 'invoice_id']);
            $table->index('created_at');
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
