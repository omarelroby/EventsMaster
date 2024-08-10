<?php

namespace App\Http\Requests\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InvoiceDetailsRequest extends FormRequest
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
            'quantity' => 'required|integer|min:1',
            'invoice_id' => 'required|integer|exists:invoices,id',
            'item_id' => 'required|integer|exists:event_items,id',
        ];
    }
    public function attributes()
    {
        return [
            'quantity'              => __('quantity'),
            'invoice_id'              => __('invoice_id'),
            'item_id'              => __('item_id')

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
