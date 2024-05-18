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
        Schema::create('models_order_items', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 10, 4);
            $table->integer('quantity')->default(1);
            $table->foreignId('order_id');
            $table->foreignId('product_id');
            $table->foreign('order_id')->references('id')->on('models_orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('models_products')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models_order_items');
    }
};
