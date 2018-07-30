<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'order_type',
        'pickup_time',
        'user_id',
        'name',
        'last_name',
        'address',
        'address2',
        'zipcode',
        'phone_number',
        'email',
        'items',
        'price',
        'status_id',
        'taxes',
        'comments'
    ];

    protected $appends = ['hiddenOrder'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status of the order.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function isHidden()
    {
        return !! Hideable::where('order_id', request('id'))->count();
    }

    public function getIsHiddenOrderAttribute()
    {
        return $this->isHiddenOrder();
    }

    public function isHiddenOrder()
    {
        return $this->hasMany(Hideable::class);
    }

    public function getHiddenOrderAttribute()
    {
        return $this->hiddenOrder();
    }

    public function hiddenOrder()
    {
        $attributes = ['order_id' => $this->id];

        return $this->isHiddenOrder()->where($attributes)->exists();
    }

    public function numberOfOrdersProcessedToday()
    {
        $when = 'created_at';
        $today =  date('Y-m-d');

        return Hideable::whereDate($when, $today)->where('product_id', null)->count();
    }

    public function todaysOrders()
    {
        $when = 'created_at';
        $today =  date('Y-m-d');

        return $this->whereDate($when, $today)->orderBy('id', 'desc')->get();
    }

    public function todaysOrdersCount()
    {
        return $this->todaysOrders()->count();
    }

    public function price()
    {
        return money_format('$%i', ($this->price / 100));
    }

    public function tax()
    {
        return $this->taxes / 100;
    }

    public function subtotal()
    {
        return money_format('$%i', ($this->price - $this->taxes ) / 100);
    }

    public function yearlyTotal()
    {
        return $this->selectRaw('year(created_at) year, sum(price / 100) total')
                            // ->whereRaw('year(created_at) = year(curdate())') let our customer pick
                            ->groupBy('year')
                            ->orderBy('year', 'desc')
                            ->get();
    }

    public function totalOrders()
    {
        return $this->selectRaw('monthname(created_at) months, year(created_at) year, sum(price / 100) total')
                            ->whereRaw('year(created_at) = year(curdate())')
                            ->groupBy('months', 'year')
                            ->orderBy('created_at')
                            ->pluck('total', 'months', 'year');
    }

    public function taxCollection()
    {
        $taxcollection = [];
        foreach ($this->totalOrders()->values() as $taxes) {
            array_push($taxcollection, $taxes * 0.08);
        }
        $taxcollection = collect($taxcollection);
        return $taxcollection;
    }

    public function totalOrdersYearBefore()
    {
        return $this->selectRaw('monthname(created_at) months, year(created_at) year, sum(price / 100) total')
                            ->whereRaw('year(created_at) = year(curdate()) - 1')
                            ->groupBy('months', 'year')
                            ->orderBy('created_at')
                            ->pluck('total', 'months', 'year');
    }

    public function taxCollectionYearBefore()
    {
        $taxcollectionYearBefore = [];
        foreach($this->totalOrdersYearBefore()->values() as $taxes){
            array_push($taxcollectionYearBefore, $taxes * 0.08);
        };

        $taxcollectionYearBefore = collect($taxcollectionYearBefore);
        return $taxcollectionYearBefore;
    }

    public function averageOrder()
    {
        return $this->selectRaw('avg(price) Average, monthname(created_at) month, year(created_at) year' )
                            ->whereRaw('year(created_at) = year(curdate())')
                            ->groupBy('month', 'year')
                            ->orderBy('created_at' )
                            ->get();
    }
}
