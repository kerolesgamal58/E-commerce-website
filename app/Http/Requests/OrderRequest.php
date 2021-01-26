<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_id' => 'required|numeric|exists:countries,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'shipping_company_id' => 'required|numeric|exists:shippings,id',
            'address' => 'required|string',
            'postcode' => 'required|numeric',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
        ];
    }
}
