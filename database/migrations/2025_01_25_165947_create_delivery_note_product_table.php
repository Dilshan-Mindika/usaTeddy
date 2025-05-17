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
        Schema::create('delivery_note_product', function (Blueprint $table) {
            $table->foreignId('delivery_note_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->primary(['product_id', 'delivery_note_id']);
            $table->string('vehicle_number')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('driver_phone')->nullable();
            $table->decimal('quantity');
            $table->decimal('unit_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_note_product');
    }
};
