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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code',255)->nullable();
            $table->string('name',255)->nullable();
            $table->string('brand',255)->nullable();
            // $table->date('purchase_date')->nullable();
            // $table->integer('purchase_qty')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('cost_price',8,2)->nullable();
            $table->decimal('selling_price',8,2)->nullable();
            // $table->decimal('total',8,2)->nullable();
            $table->string('vendor_name',255)->nullable();
            $table->string('vendor_address',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
