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
            $table->uuid('id')->primary();
            $table->uuid('customer_id');
            $table->uuid('shiping_address_id');
            $table->uuid('shipping_id');
            $table->uuid('promo_id');
            $table->string('code');
            $table->integer('status')->default(0);
            $table->smallInteger('del_flg')->default(0);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('shiping_address_id')->references('id')->on('shipping_addresses');
            $table->foreign('shipping_id')->references('id')->on('shippings');
            $table->foreign('promo_id')->references('id')->on('promos');
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
