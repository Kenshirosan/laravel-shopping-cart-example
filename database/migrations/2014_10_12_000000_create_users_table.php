<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('confirmed')->default(false);
            $table->string('confirmation_token', 100)->nullable()->unique();
            $table->boolean('employee')->default(false);
            $table->boolean('theboss')->default(false);
            $table->rememberToken();
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
