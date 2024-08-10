<?php

namespace App\Http\Requests\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DriverRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'tag_name' => 'required|string|max:255',
            'type_id' => 'required|string|max:255',
            'date_birth' => 'required|date',
            'phone1' => 'required|string|max:255',
            'phone2' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8048', // Adjust file size and allowed mime types as needed
            'shipper_id' => 'required|exists:shippers,id',
        ];
    }
    public function attributes()
    {
        return [
            'name'              => __('name'),
            'surname'              => __('surname'),
            'tag_name'              => __('tag_name'),
            'id_card'              => __('id_card'),
            'type_id'              => __('type_id'),

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
