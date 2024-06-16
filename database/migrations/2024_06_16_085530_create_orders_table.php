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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id')->index('orders_users_id_foreign');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('address');
            $table->string('district');
            $table->string('city');
            $table->string('phone');
            $table->string('email');
            $table->longText('content')->nullable();
            $table->integer('total');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('orders');
    }
};
