<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_type')->default('Delivery');
            $table->string('pickup_time')->nullable();
            $table->unsignedInteger('user_id')->nullable()->index();
//            $table->morphs('hideable');
            $table->unsignedInteger('hideable_id')->nullable()->unique();
            $table->string('hideable_type', 80)->nullable();
            $table->string('name')->required();
            $table->string('last_name')->required();
            $table->string('address')->required();
            $table->string('address2')->nullable();
            $table->string('zipcode')->required();
            $table->string('phone_number')->required();
            $table->string('email')->required();
            $table->longText('items')->required();
            $table->unsignedInteger('status_id')->default(1);
            $table->decimal('price', 10, 2)->required();
            $table->integer('taxes');
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
