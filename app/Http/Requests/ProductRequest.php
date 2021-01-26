<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required',
            'image' => 'sometimes|nullable',
            'image.*' => 'image|mimes:jpg,jepg,png',
            'main_image' => 'required_without:id|image|mimes:jpg,jepg,png',
            'description' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'sometimes|nullable|in:pending,refused,active',
            'reason' => 'sometimes|nullable|string',
            'start_at' => 'sometimes|nullable|date',
            'end_at' => 'sometimes|nullable|date',
            'start_offer_at' => 'sometimes|nullable|date',
            'end_offer_at' => 'sometimes|nullable|date',
            'price_offer' => 'sometimes|nullable|numeric',
            'department_id' => 'required|numeric',
            'trademark_id' => 'required|numeric',
            'manufacture_id' => 'required|numeric',
            'color_id' => 'sometimes|nullable|numeric',
            'size_id' => 'required_with:size|sometimes|nullable|numeric',
            'weight_id' => 'required_with:weight|sometimes|nullable|numeric',
            'size' => 'required_with:size_id|sometimes|nullable',
            'weight' => 'required_with:weight_id|sometimes|nullable',
            'currency_id' => 'required|numeric',
            'mall' => 'sometimes|nullable',
            'mall.*' => 'numeric',
            'other_data' => 'sometimes|nullable',
            'other_data.*' => 'string',
        ];
    }
}
