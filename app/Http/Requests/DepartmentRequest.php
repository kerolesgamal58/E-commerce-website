<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'logo' => 'sometimes|nullable|image|mimes:png,jpg,jepg',
            'description' => 'sometimes|nullable',
            'keyword' => 'sometimes|nullable',
            'parent_id' => 'sometimes|nullable|numeric'
        ];
    }
}
