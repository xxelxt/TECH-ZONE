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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedBigInteger('categories_id');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('brands_id');
            $table->unsignedBigInteger('sub_id');
            $table->string('size')->nullable();
            $table->double('price')->nullable();
            $table->double('price_new')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->longText('content')->nullable();
            $table->integer('featured_product')->default(0);
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('products');
    }
};
