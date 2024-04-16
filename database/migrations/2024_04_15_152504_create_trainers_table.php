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
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('trainer_code', 255)->nullable();
            $table->string('trainer_image',255)->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('contact', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('join_date')->nullable();
            $table->decimal('basic_salary')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
