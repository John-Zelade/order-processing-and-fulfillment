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
            $table->string('OrderNo',100)->unique();
            $table->unsignedBigInteger('CustomerID');
            $table->string('Status');
            $table->string('OrderDate');
            $table->string('ShippedAddress');
            $table->string('OrderTotal');

            $table->foreign('CustomerID')->references('id')->on('customers');

            $table->timestamps();
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
