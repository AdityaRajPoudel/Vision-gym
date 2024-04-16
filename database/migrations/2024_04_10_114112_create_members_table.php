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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_code', 255)->nullable();
            $table->string('reg_code', 255)->nullable();
            $table->date('reg_date')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('contact', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->date('dor')->nullable();
            $table->date('doe')->nullable();
            $table->integer('age')->nullable();
            $table->decimal('initial_weight')->nullable();
            $table->longText('description')->nullable();
            $table->time('gym_time')->nullable();
            $table->string('plan', 255)->nullable();
            $table->decimal('discount', 8, 2)->nullable();
            $table->decimal('sub_total',8,2)->nullable();
            $table->decimal('grand_total',8,2)->nullable();
            $table->decimal('tender',8,2)->nullable();
            $table->decimal('return',8,2)->nullable();
            $table->decimal('due',8,2)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('remarks', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
