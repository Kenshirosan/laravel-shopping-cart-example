<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'address_2' => 'required',
            'zipcode' => 'required|numeric',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'is_primary' => 'required|boolean'
        ];
    }
}
