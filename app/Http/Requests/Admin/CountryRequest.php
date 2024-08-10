<?php

namespace App\Http\Requests\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

 use Illuminate\Http\Exceptions\HttpResponseException;
class CountryRequest extends FormRequest
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
            'flag'           => 'required',
            'name'             => 'required|alpha_dash|min:3|max:24',
            'code'             => 'required|alpha_dash|min:3|max:6',
            "initials"          => "required",
            "nationality"        => "required"
        ];


    }

    public function attributes()
    {
        return [
            'name'              => __('name'),
            'code'                => __('code')
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
