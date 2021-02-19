<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Interfaces\Sort;

class SortOrdersByTime extends Model implements Sort
{
    use HasFactory;

    const breakfastTimeLimit = '11:00:00';
    const lunchTimeLimit = '15:00:00';
    protected $table = 'sort_orders_by_times';

    protected $fillable = ['time', 'date', 'day', 'type', 'moment'];

    public function __construct() {}

    protected function getPartOfDay()
    {
        $curTime = Carbon::now()->toTimeString();
        $dayPart = 'Dinner';

        if($curTime < self::breakfastTimeLimit) {
            $dayPart = 'Breakfast';
        }

        if($curTime > self::breakfastTimeLimit && $curTime < self::lunchTimeLimit) {
            $dayPart = 'Lunch';
        }

        return $dayPart;
    }

    private static function record($type)
    {
        $static = new static();

        return $static->create([
            'time' => Carbon::now()->toTimeString(),
            'date' => Carbon::now()->toDateString(),
            'day' => ucfirst(Carbon::now()->dayName),
            'type' => $type,
            'moment' => $static->getPartOfDay()
        ]);
    }
}
