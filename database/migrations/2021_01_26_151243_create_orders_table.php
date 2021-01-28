<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("productID")->nullable();
            $table->bigInteger("tuserID")->nullable();
            $table->bigInteger("userID")->nullable();
            $table->bigInteger("factorID")->nullable();
            $table->integer("count")->nullable();
            $table->bigInteger("price")->nullable();
            $table->bigInteger("sumprice")->nullable();
            $table->string("status",64)->nullable();
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
}
