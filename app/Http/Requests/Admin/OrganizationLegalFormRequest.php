<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrganizationLegalFormRequest extends FormRequest
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
            'legal_form_code'           => 'required',
            'legal_form_abv'             => 'required',
            'legal_form_spc' => 'required',
            'legal_form_sn'             => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'legal_form_code'              => __('legal_form_code'),
            'legal_form_abv'                => __('legal_form_abv'),
            'legal_form_sn'  => __('legal_form_sn')
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
