<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddressUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_user', function (Blueprint $table) {
            $table->unsignedBigInteger('address_id')->primary();
            $table->unsignedInteger('user_id')->nullable();
            $table->boolean('is_primary')->default(true);
            $table->boolean('is_work')->default(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');

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
        Schema::dropIfExists('address_user');
    }
}
