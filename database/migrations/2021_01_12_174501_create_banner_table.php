<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("BannergpsID")->nullable();
            $table->string("img",50)->nullable();
            $table->string("title",128)->nullable();
            $table->enum("show",["Yes","No"])->nullable();
            $table->enum("linkable",["Yes","No"])->nullable();
            $table->text("link")->nullable();
            $table->timestamp("start_date")->nullable();
            $table->timestamp("end_date")->nullable();
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
        Schema::dropIfExists('banner');
    }
}
