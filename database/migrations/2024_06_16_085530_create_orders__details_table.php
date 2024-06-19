<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders__details', function (Blueprint $table) {
            $table->unsignedInteger('orders_id')->index('orders__details_orders_id_foreign');
            $table->unsignedInteger('product_id')->index('orders__details_product_id_foreign');
            $table->string('name');
            $table->string('image');
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders__details');
    }
};
