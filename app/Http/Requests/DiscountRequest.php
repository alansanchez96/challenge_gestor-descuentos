<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'discounts_name' => 'required|string|min:3|max:100|unique:discounts,name',
            'discount_brand_id' => 'required',
            'discounts_access_type_code' => 'required',
            'discounts_priority' => 'required|numeric|integer',
            'discounts_region_id' => 'required',
            /* 'discount_start_date_1' => 'required|numeric|integer',
            'discount_end_date_1' => 'required|numeric|integer',
            'discount_code_1' => 'required_if:discount_percent_1,null|max:15',
            'discount_percent_1' => 'required_if:discount_code_1,integer' */
        ];
    }
}
