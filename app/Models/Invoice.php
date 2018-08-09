<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	/**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name',
        'last_name',
        'address',
        'address2',
        'zipcode',
        'phone_number',
        'email',
        'products',
        'price',
        'paid',
        'taxes'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function pay()
    {
    	$this->paid = true;

    	return $this->save();
    }
}
