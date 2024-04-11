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
            $table->unsignedBigInteger('category_id')->nullable();
            $table->date('purchase_date')->nullable();
            $table->integer('purchas_qty')->nullable();
            $table->decimal('initial_weight',8,2)->nullable();
            $table->longText('description')->nullable();
            $table->string('plan',255)->nullable();
            $table->decimal('cost_per_item',8,2)->nullable();
            $table->decimal('sub_total',8,2)->nullable();
            $table->string('vendor',255)->nullable();
            $table->string('vendor_address',255)->nullable();
            $table->tinyInteger('status')->default(0);  
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
