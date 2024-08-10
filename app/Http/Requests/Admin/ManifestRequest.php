<?php

namespace App\Http\Requests\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ManifestRequest extends FormRequest
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
        $manifestId = $this->route('manifest') ? $this->route('manifest') : null;

        return [
            'manifest_number' => [
                'required',
                'string',
                'max:255',
                'unique:manifest,manifest_number,' . $manifestId,
            ],
            'date_receiving_shipment' => 'required|date',
            'quantity' => 'required|integer',
            'number_clearance_customs' => 'nullable|string|max:255',
            'shipper_id' => 'required|exists:shippers,id',
            'truck_id' => 'required|exists:trucks,id',
            'driver_id' => 'required|exists:drivers,id',
            'organization_id' => 'required|exists:organizations,id',
            'event_id' => 'required|exists:events,id',
            'list_type_id' => 'required|exists:listed_types,id',
        ];
    }
    public function attributes()
    {
        return [
            'manifest_number'              => __('manifest_number'),
            'quantity'              => __('quantity'),
            'shipper_id'              => __('shipper_id'),
            'truck_id'              => __('truck_id'),
            'driver_id'              => __('driver_id'),
            'organization_id'              => __('organization_id'),
            'event_id'              => __('event_id'),
            'list_type_id'              => __('list_type_id'),

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
