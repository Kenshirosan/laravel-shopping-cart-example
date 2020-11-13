<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER record_sorted_orders
            AFTER INSERT ON orders
            FOR EACH ROW
            INSERT INTO sort_orders_by_times (time, date, day, type, moment)
            VALUES(CURTIME(), DATE(NOW()), DAYNAME(NOW()), (SELECT get_order_type()),(SELECT part_of_day()));
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trigger');
    }
}
