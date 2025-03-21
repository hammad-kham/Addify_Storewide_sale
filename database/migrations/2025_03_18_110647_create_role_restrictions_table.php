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
        Schema::create('role_restrictions', function (Blueprint $table) {
            $table->id();
            $table->string('shopName');
            $table->boolean('sale_type')->default(1); 
            $table->integer('sale_amount')->nullable();
            $table->string('start_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_date')->nullable();
            $table->string('end_time')->nullable();
            $table->boolean('isGuest')->default(0); 
            $table->boolean('user_selection')->default(1);
            $table->text('specific_user_tags')->nullable(); 
            $table->boolean('product_selection')->default(1);
            $table->text('specific_products')->nullable();
            $table->text('include_collections')->nullable(); 
            $table->text('product_tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_restrictions');
    }
};
