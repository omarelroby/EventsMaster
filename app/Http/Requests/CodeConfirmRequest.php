<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeConfirmRequest extends FormRequest
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

            'sms_code' => 'required|numeric',
            "mobile"   => 'required|string|numeric',
            "mobile_code"   => 'required|string|numeric',
        ];


    }

    public function attributes()
    {
        return [
            'mobile' => __('Mobile'),
            'mobile_code' => __('Mobile code'),
            'code' => __('SMS Code'),
        ];
    }
}
