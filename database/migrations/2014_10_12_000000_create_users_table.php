<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("moarefID")->nullable();
            $table->bigInteger("regionID")->nullable();
            $table->string('name');
            $table->string('fname')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string("code_meli", 20)->nullable();
            $table->timestamp("birth")->nullable();
            $table->string("last_version", 20)->nullable();
            $table->string("last_order", 20)->nullable();
            $table->string("phone", 20)->nullable();
            $table->string("whatsapp", 20)->nullable();
            $table->rememberToken();
            $table->enum("roll", ["Developer", "Owner", "Admin", "Operator", "Supplier", "Courier Manager", "Delivery", "Customer"])->default("Customer");
            $table->enum("special", ["Yes", "No"])->nullable();
            $table->string("codeposti", 24)->nullable();
            $table->enum("sex", ["IDK", "Men", "Women"])->default("IDK");
            $table->string("pushid", 124)->nullable();
            $table->enum("block", ["Yes", "No"])->default("No");
            $table->enum("taminkind", ["IDK", "Static", "Dynamic"])->default("IDK");
            $table->string("img", 50)->nullable();
            $table->string("location", 64)->nullable();
            $table->string("bank",22)->nullable();
            $table->enum("state",["Ready","Out","Working"])->nullable();
            $table->enum("vehicle",["Car","Motor","Bike"])->nullable();
            $table->integer("comision")->nullable();
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
        Schema::dropIfExists('users');
    }
}
