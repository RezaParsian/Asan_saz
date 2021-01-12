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
            $table->bigInteger("category");
            $table->string("title",128);
            $table->enum("action",["one_click","pay"]);
            $table->bigInteger("price");
            $table->integer("max");
            $table->text("des");
            $table->string("img",50);
            $table->json("gallery",50);
            $table->enum("show",["Yes","No"]);
            $table->integer("olaviyat");
            $table->enum("highrate",["Yes","No"]);
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
