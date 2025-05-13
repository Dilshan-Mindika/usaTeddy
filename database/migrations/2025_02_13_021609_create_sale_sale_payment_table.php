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
        Schema::create('sale_sale_payment', function (Blueprint $table) {
            $table->foreignId('sale_id')->constrained(); //50,000
            $table->foreignId('sales_payment_id')->constrained(); //40,000
            $table->decimal('amount'); //20,000
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_salee_payment');
    }
};
