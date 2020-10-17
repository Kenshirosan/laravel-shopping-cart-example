<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->string('address', 255);
            $table->string('address_2', 255)->nullable();
            $table->string('zipcode', 50);
            $table->string('city', 100)->default('Marseille')->index();
            $table->json('state');
            $table->json('country');
            $table->boolean('is_primary')->default(true);
            $table->timestamps();
        });

        Schema::create('address_user', function (Blueprint $table) {
            $table->unsignedBigInteger('address_id');
            $table->unsignedInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->primary(['address_id', 'user_id']);
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
        Schema::dropIfExists('addresses');
    }
}
