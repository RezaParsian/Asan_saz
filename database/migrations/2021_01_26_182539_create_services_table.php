<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("userID")->nullable();
            $table->bigInteger("productID")->nullable();
            $table->integer("comision")->nullable();
            $table->enum("mojavez",["Yes","No"])->nullable();
            $table->text("dec")->nullable();
            $table->enum("status",["Yes","No"])->nullable();
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
        Schema::dropIfExists('services');
    }
}
