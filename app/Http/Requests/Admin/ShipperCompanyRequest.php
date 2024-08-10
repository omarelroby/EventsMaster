<?php

namespace App\Http\Requests\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShipperCompanyRequest extends FormRequest
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

        $shipperId = $this->route('shipper') ? $this->route('shipper')->id : null;

        return [
            'account_number' => [
                'required',
                'string',
                'max:255',
                'unique:shippers,account_number,' . $shipperId,
            ],
            'shipper_name' => 'required|string|max:255',
            'name_commercial' => 'nullable|string|max:255',
            'abbreviation' => 'nullable|string|max:50',
            'id_registry_commercial' => 'nullable|string|max:255',
            'file_register_commercial' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240', // Adjust mime types and size as needed
            'registry_id_tax' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'zip' => 'nullable|string|max:20',
            'phone1' => 'nullable|string|max:20',
            'phone2' => 'nullable|string|max:20',
        ];


    }

    public function attributes()
    {
        return [
            'account_number'              => __('account_number'),
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
