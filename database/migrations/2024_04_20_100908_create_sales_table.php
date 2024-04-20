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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('bill_no')->nullable();
            $table->date('sales_date');
            $table->decimal('discount_percentage', 8, 2)->nullable(); 
            $table->decimal('discount_amount', 8, 2)->nullable(); 
            $table->decimal('discounted_amount', 8, 2)->nullable(); 
            $table->decimal('subtotal', 8, 2)->nullable(); 
            $table->decimal('total', 8, 2)->nullable(); 
            $table->decimal('grand_total', 8, 2)->nullable(); 
            $table->decimal('tender',8,2)->nullable();
            $table->decimal('return',8,2)->nullable();
            $table->decimal('due',8,2)->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
