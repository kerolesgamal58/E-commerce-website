<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MallRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'country_id' => 'required|numeric|exists:countries,id',
            'facebook' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'website' => 'sometimes|nullable|url',
            'contact_name' => 'sometimes|nullable|string',
            'address' => 'sometimes|nullable|string',
            'lat' => 'sometimes|nullable',
            'lng' => 'sometimes|nullable',
            'logo' => 'sometimes|nullable|image|mimes:png,jpg,jepg',
        ];
    }
}
