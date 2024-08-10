<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrganizationClassificationRequest extends FormRequest
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
            'classification_code'           => 'required',
            'classification_spc'            => 'required',
            'classification_sn'             => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'classification_code'              => __('classification_code'),
            'classification_abv'                => __('classification_abv'),
            'classification_sn'                  => __('classification_sn')
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Vaildation errors',
            'status' => '422',
            'errors' => $validator->errors(),
        ], 422));
    }
}
