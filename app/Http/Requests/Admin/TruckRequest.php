<?php

namespace App\Http\Requests\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TruckRequest extends FormRequest
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

        $truckId = $this->route('truck') ? $this->route('truck') : null;

        return [
            'no_plate' => [
                'required',
                'string',
                'max:20',
                'unique:trucks,no_plate,' . $truckId,
            ],
            'shipper_id' => [
                'required',
                'exists:shippers,id',
            ],
        ];

    }

    public function attributes()
    {
        return [
            'no_plate'              => __('no_plate'),
            'shipper_id'              => __('shipper_id'),

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
