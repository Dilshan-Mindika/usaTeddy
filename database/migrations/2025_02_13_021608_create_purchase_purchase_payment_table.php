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
        Schema::create('purchase_purchase_payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained(); //50,000
            $table->foreignId('purchase_payment_id')->constrained(); //40,000
            $table->decimal('amount');//20000
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_purchase_payment');
    }
};
