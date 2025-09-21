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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_service');
            $table->foreign('id_order')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('id_service')->references('id')->on('services')->onDelete('cascade');
            $table->integer('qty');
            $table->decimal('subtotal', 10, 2);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
