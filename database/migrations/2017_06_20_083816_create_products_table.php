<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->unsignedInteger('option_group_id')->unique();
            $table->unsignedInteger('category_id')->unique();
            $table->string('category');
            $table->string('slug')->unique();
            $table->text('description');
            $table->integer('price');
            $table->string('image')->unique();
            $table->timestamps();

            // $table->foreign('option_group_id')->references('id')->on('option_groups');
            // $table->foreign('category_id')->references('id')->on('categories'); NEED TO FIX THESE THINGS
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
