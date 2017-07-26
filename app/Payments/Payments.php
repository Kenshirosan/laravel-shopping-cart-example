<?php

namespace App\Payments;

use Illuminate\Http\Request;

abstract class Payments
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }    
}