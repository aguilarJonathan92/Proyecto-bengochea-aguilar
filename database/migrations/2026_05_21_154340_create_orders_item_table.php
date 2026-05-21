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
        Schema::create('orders_item', function (Blueprint $table) {
            $table->id();
            // Si por alguna razón extrema se borra la orden completa, sus ítems se van con ella
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            
            // Asumiendo que tus productos también usarán SoftDeletes, aplicamos cascade seguro
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            $table->unsignedInteger('quantity');
            $table->decimal('price', 10, 2); // Precio congelado del momento de la compra
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_item');
    }
};
