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
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->id();
            $table->string('shopName');
            $table->boolean('is_top_bar_enable')->default(true);
            $table->string('notification_content')->nullable();
            $table->string('notification_bg_color')->nullable();
            $table->string('notification_color')->nullable();
            $table->boolean('is_popup_enable')->default(true);
            $table->text('popup_content')->nullable();
            $table->string('popup_bg_color')->nullable();
            $table->string('popup_color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_settings');
    }
};
