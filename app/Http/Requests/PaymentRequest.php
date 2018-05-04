<?php

namespace App\Http\Requests;

use \Cart as Cart;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && ! auth()->user()->isEmployee() && Cart::total() >= 1500;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_type' => 'required|string',
            'pickup_time' => 'nullable|string',
            'name' => 'required|exists:users,name',
            'last_name' => 'required|exists:users,last_name',
            'address' => 'required|string',
            'address2' => 'nullable|string',
            'zipcode' => 'required|numeric',
            'phone_number' => 'required|exists:users,phone_number',
            'email' => 'required|exists:users,email',
            'total' => 'nullable|numeric',
            'taxes' => 'nullable|numeric',
            'code' => 'nullable|string',
            'comments' => 'nullable|string'
        ];
    }
}
