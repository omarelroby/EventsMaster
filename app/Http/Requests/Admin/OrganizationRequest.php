<?php

namespace App\Http\Requests\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrganizationRequest extends FormRequest
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
            'name' => 'required|alpha_dash|min:3|max:24',
            'organization_Sn' => 'required|alpha_dash|min:3|max:24',
            'commercial_Name' => 'required|alpha_dash|min:3|max:24',
            'name_tag' => 'required|alpha_dash|min:3|max:24',
            'email' => 'required',
            'password' => 'nullable|confirmed',
            'establish_date'  => 'required',
            'zip'=>  'required',

            'Phone1' => 'required' ,
            'Phone2' => 'required',
            'WhatsApp' => 'required',
            'head_office_address'  =>'required',
            'website'=>  'required',
            'city_id' => 'required|exists:cities,id',
            'nationality_country_Id' => 'required|exists:countries,id',
            'org_classification_id'  => 'required|exists:org_clasifications,id',
            'legal_form_id'=>  'required|exists:org_legal_forms,id',
            'organization_parent_Sn'=>  'required',
            'manager_id' => 'required|exists:persons,id',
            'iban'  => 'required',
            'swift_code'=>  'required',
            'bank' =>'required',
            'account_number' =>'required',

        ];


    }

    public function attributes()
    {
        return [
            'name'              => __('name'),
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
