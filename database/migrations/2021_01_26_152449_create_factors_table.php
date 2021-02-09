<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("userID")->comment("user id")->nullable();
            $table->bigInteger("ouserID")->comment("operator id")->nullable();
            $table->bigInteger("tuserID")->comment("tamin konande id")->nullable();
            $table->bigInteger("puserID")->comment("peyk id")->nullable();
            $table->bigInteger("addressID")->nullable();
            $table->integer("totalprice")->nullable();
            $table->integer("peykprice")->nullable();
            $table->integer("comision")->nullable();
            $table->timestamp("recive")->nullable();
            $table->text("userdes")->nullable();
            $table->text("operatordes")->nullable();
            $table->double("rate")->nullable();
            $table->double("peykrate")->nullable();
            $table->text("peykratedes")->nullable();
            $table->timestamp("peykrecive")->nullable();
            $table->timestamp("delevry")->nullable();
            $table->string("status",86)->nullable();
            $table->timestamp("Rddate")->nullable()->comment('Request Delevry Date');
            $table->enum("bale",["Yes","No"])->nullable();
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
        Schema::dropIfExists('factors');
    }
}
