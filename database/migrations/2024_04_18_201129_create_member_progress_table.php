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
        Schema::create('member_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->date('date');
            $table->decimal('weight', 8, 2); // Using decimal for more precise weight values
            $table->decimal('height', 8, 2); // Using decimal for more precise height values
            $table->decimal('bmi', 8, 2); // BMI (Body Mass Index)
            $table->decimal('body_fat_percentage', 8, 2); // Body Fat Percentage
            $table->decimal('muscle_mass', 8, 2); // Muscle Mass
            $table->decimal('target_weight', 8, 2)->nullable(); // Target Weight
            $table->date('target_date')->nullable(); // Target Date
            $table->integer('workout_duration')->nullable(); // Workout Duration in minutes
            $table->string('exercise_type')->nullable(); // Exercise Type
            $table->string('intensity_level')->nullable(); // Intensity Level
            $table->integer('calories_burned')->nullable(); // Calories Burned
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_progress');
    }
};
