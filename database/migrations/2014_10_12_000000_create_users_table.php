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
            $table->bigInteger("moaref_id")->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string("code_meli",20)->nullable();
            $table->timestamp("birth")->nullable();
            $table->string("last_version",20)->nullable();
            $table->string("last_order",20)->nullable();
            $table->string("address",512)->nullable();
            $table->string("whatsapp",20)->nullable();
            $table->rememberToken();
            $table->enum("roll",["Developer","Owner","Admin","Customer"])->default("Customer");
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
