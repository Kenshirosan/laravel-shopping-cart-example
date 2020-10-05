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
            $table->boolean('today')->default(false);
            $table->boolean('holiday_special')->default(false);
            $table->unsignedInteger('category_id')->index();
            $table->string('type');
//            $table->morphs('hideable');
            $table->unsignedInteger('hideable_id')->nullable()->unique();
            $table->string('hideable_type', 80)->nullable();
            $table->string('slug')->unique();
            $table->text('description');
            $table->integer('price');
            $table->string('image');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
