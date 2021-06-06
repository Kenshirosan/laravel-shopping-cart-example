<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE FUNCTION part_of_day() RETURNS TEXT
                BEGIN
                    DECLARE cur_time, day_part TEXT;
                    SET cur_time = CURTIME();
                    IF cur_time < \'11:00:00\' THEN
                        SET day_part = \'Breakfast\';
                    ELSEIF cur_time > \'11:00:00\' AND cur_time < \'15:00:00\' THEN
                        SET day_part = \'Lunch\';
                    ELSE
                        SET day_part = \'Dinner\';
                    END IF;
                    RETURN day_part;
                END;

                CREATE FUNCTION get_order_type()
                RETURNS TEXT READS SQL DATA
                    BEGIN
                        RETURN (SELECT order_type FROM orders WHERE id = (SELECT LAST_INSERT_ID()));
                    END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('function');
    }
}
