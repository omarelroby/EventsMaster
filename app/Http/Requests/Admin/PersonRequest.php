<?php

namespace App\Http\Requests\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PersonRequest extends FormRequest
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
            'first_name'             => 'required|alpha_dash|min:3|max:24',
            'second_name'             => 'required|alpha_dash|min:3|max:6',
            'country_id' =>  'required|exists:countries,id',
            'surName'=> 'required',
            'email' =>  'required|unique:persons,email',

        ];


    }

    public function attributes()
    {
        return [
            'first_name'              => __('first_name'),
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
