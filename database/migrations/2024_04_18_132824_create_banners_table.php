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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string("banner_title",255);
            $table->text("banner_description")->nullable();
            $table->string("banner_image",255)->nullable();
            $table->string("banner_btn_text",255)->nullable();
            $table->string("banner_btn_link",255)->nullable();
            $table->integer("banner_order");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
