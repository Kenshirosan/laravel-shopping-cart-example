<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('second_option_group_id')->index();
            $table->string('name', 30)->index();
            $table->timestamps();

            $table->foreign('second_option_group_id')->references('id')->on('second_option_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('second_options');
    }
}
