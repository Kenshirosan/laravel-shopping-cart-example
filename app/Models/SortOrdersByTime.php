<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortOrdersByTime extends Model
{
    use HasFactory;

    protected $table = 'sort_orders_by_times';

    protected $fillable = ['time', 'date', 'day', 'type', 'moment'];
}
