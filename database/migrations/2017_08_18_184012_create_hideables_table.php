<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHideablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hideables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hideable_id')->nullable()->unique();
            $table->string('hideable_type', 80);
            $table->timestamps();
//            $table->morphs('hideable');
//            $table->primary(['id', 'hideable_id', 'hideable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hideables');
    }
}
