<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupables', function (Blueprint $table) {
            $table->primary(['category_id', 'option_group_id', 'groupable_id', 'groupable_type']);

            $table->unsignedInteger('category_id');
            $table->unsignedInteger('option_group_id');
            $table->unsignedInteger('groupable_id');
            $table->string('groupable_type');
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
        Schema::dropIfExists('groupables');
    }
}
