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
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('zipcode');
            $table->string('phone_number');
            $table->boolean('confirmed')->default(false);
            $table->string('confirmation_token', 100)->nullable()->unique();
            $table->boolean('employee')->default(0);
            $table->boolean('theboss')->default(0);
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
