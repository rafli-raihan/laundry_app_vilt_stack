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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('cascade');
            $table->date('order_date');
            $table->date('order_end_date')->nullable();
            $table->tinyInteger('order_status')->default(0);
            $table->decimal('order_pay', 10, 2);
            $table->decimal('order_change', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
