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
        Schema::create('order_pickups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_order')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('cascade');
            $table->date('pickup_date');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_pickups');
    }
};
