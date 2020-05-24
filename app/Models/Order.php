<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\User;
use DB;

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
    protected $appends = ['hiddenOrder', 'products'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class)->with('products')->with('options');
    }

    public function details()
    {
        return $this->orderDetails;
    }

    public function getProducts()
    {
        $sql_results =  DB::select('
            SELECT
                od.qty, od.cart_row_id, od.wayofcooking, p.name product, op.name option
            FROM
                order_details od
            LEFT JOIN orders o ON
                od.order_id = o.id
            LEFT JOIN options op ON
                od.option_id = op.id
            LEFT JOIN products p ON
                od.product_id = p.id
            WHERE
                o.id = ' . $this->id
        );

        $products = array();

        foreach ($sql_results as $sql_result) {
            $sql_result = get_object_vars($sql_result);

            if (!array_key_exists($sql_result['cart_row_id'], $products)) {
                $products[$sql_result['cart_row_id']] = array(
                    'id_product' => $sql_result['cart_row_id'],
                    'product_name' => $sql_result['product'],
                    'qty' => $sql_result['qty'],
                );
            }

            $option_name = 'options';
            $option_value = $sql_result['option'];

            if (array_key_exists($option_name, $products[$sql_result['cart_row_id']])) {
                $option_value = $products[$sql_result['cart_row_id']][$option_name] . ', ' . $option_value;
            }

            $products[$sql_result['cart_row_id']][$option_name] = $option_value;

            $wayofcooking = $sql_result['wayofcooking'];
            if (array_key_exists($wayofcooking, $products[$sql_result['cart_row_id']])) {
                $wayofcooking = $products[$sql_result['cart_row_id']]['wayofcooking'];
            }

            $products[$sql_result['cart_row_id']]['wayofcooking'] = $wayofcooking;
        }
        return $products;
    }

    public function getproductsAttribute()
    {
        return $this->getProducts();
    }

    public function bestCustomers()
    {
        return $this->selectRaw('year(created_at) year, sum(price) total, user_id, name, last_name, email')
            ->whereRaw('year(created_at) = year(curdate())')
            ->groupBy('user_id', 'email', 'last_name', 'name', 'year')
            ->orderBy('total', 'desc')
            ->get();
    }

    /**
     * Get the status of the order.
     */
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function isHidden()
    {
        return !!Hideable::where('order_id', request('id'))->count();
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
        $today = date('Y-m-d');

        return Hideable::whereDate($when, $today)->where('product_id', null)->count();
    }

    public function todaysOrders()
    {
        $when = 'created_at';
        $today = date('Y-m-d');

        return $this->whereDate($when, $today)->with('status')->orderBy('id', 'desc')->get();
    }

    public function todaysOrdersCount()
    {
        return $this->todaysOrders()->count();
    }

    public function price()
    {
        return sprintf('$%01.2f', $this->price);
    }

    public function tax()
    {
        return $this->taxes;
    }

    public function subtotal()
    {
        return sprintf('$%01.2f', $this->price - $this->taxes);
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
            $taxcollection[] = $taxes * 0.08;
        }

        return collect($taxcollection);
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
        foreach ($this->totalOrdersYearBefore()->values() as $taxes) {
            $taxcollectionYearBefore[] = $taxes * 0.08;
        };

        return collect($taxcollectionYearBefore);
    }

    public function averageOrder()
    {
        return $this->selectRaw('avg(price) Average, monthname(created_at) month, year(created_at) year')
            ->whereRaw('year(created_at) = year(curdate())')
            ->groupBy('month', 'year')
            ->orderBy('created_at')
            ->get();
    }
}
