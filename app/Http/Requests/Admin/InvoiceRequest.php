<?php

namespace App\Http\Requests\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InvoiceRequest extends FormRequest
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
        $manifestId = $this->route('invoices') ? $this->route('invoices')->id : null;
        return [
            'invoice_number' => [
                'required',
                'string',
                'max:255',
                'unique:invoices,invoice_number,' . $manifestId,
            ],
            'date_Invoice' => 'required|date_format:Y-m-d H:i:s', // Date and Time format
            'organization_id' => 'required|integer|exists:organizations,id',
            'event_id' => 'required|integer|exists:events,id',
            'list_type_id' => 'required|integer|exists:listed_types,id',
        ];
    }
    public function attributes()
    {
        return [
            'invoice_number'              => __('invoice_number'),
            'date_Invoice'              => __('date_Invoice'),
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
