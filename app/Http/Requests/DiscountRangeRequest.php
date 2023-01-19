<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountRangeRequest extends FormRequest
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
        $rules = [
            'from_days_1' => 'required_if:to_days_1,null|numeric|lt:to_days_1',
            'to_days_1' => 'required_if:from_days_1,null|numeric',
            'discount_percent_1' => 'required_if:discount_code_1,null|numeric|nullable',
            'discount_code_1' => 'required_if:discount_percent_1,null|alpha_num|nullable'
        ];

        if ($this->from_days_2 || $this->to_days_2 !== null) {
            $rules = array_merge($rules, [
                'from_days_2' => 'required_if:to_days_2,null|numeric|lt:to_days_2',
                'to_days_2' => 'required_if:from_days_2,null|numeric',
                'discount_percent_2' => 'required_if:discount_code_2,null|numeric|nullable',
                'discount_code_2' => 'required_if:discount_percent_2,null|alpha_num|nullable'
            ]);

            if ($this->from_days_3 || $this->to_days_3 !== null) {
                $rules = array_merge($rules, [
                    'from_days_3' => 'required_if:to_days_3,null|numeric|lt:to_days_3',
                    'to_days_3' => 'required_if:from_days_3,null|numeric',
                    'discount_percent_3' => 'required_if:discount_code_3,null|numeric|nullable',
                    'discount_code_3' => 'required_if:discount_percent_3,null|alpha_num|nullable'
                ]);
            }
        }

        return $rules;
    }
}
