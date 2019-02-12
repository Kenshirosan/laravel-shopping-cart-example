<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_product', function (Blueprint $table) {
            $table->unsignedInteger('option_group_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();

            $table->primary(['option_group_id', 'product_id']);
            $table->foreign('option_group_id')->references('id')->on('option_groups')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
