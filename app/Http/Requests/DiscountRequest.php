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
            'discounts_name' => "required|string|min:3|max:100|unique:discounts,name,{$this->id}",
            'discounts_active' => 'required',
            'discounts_priority' => 'required|numeric|integer|between:100,1000',
            'discount_brand_id' => 'required',
            'discounts_access_type_code' => 'required',
            'discounts_region_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }
}
