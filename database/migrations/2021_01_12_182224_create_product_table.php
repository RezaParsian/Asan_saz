<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("CategoryID")->nullable();
            $table->string("title",128)->nullable();
            $table->enum("action",["one_click","pay"])->nullable();
            $table->bigInteger("buyprice")->nullable();
            $table->bigInteger("price")->nullable();
            $table->integer("max")->nullable();
            $table->text("des")->nullable();
            $table->string("img",50)->nullable();
            $table->json("gallery",50)->nullable();
            $table->enum("show",["Yes","No"])->nullable();
            $table->integer("olaviyat")->nullable();
            $table->enum("highrate",["Yes","No"])->nullable();
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
        Schema::dropIfExists('product');
    }
}
