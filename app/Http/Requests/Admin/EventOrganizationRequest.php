<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventOrganizationRequest extends FormRequest
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
            'organization_id' => 'required',
             'event_id' => 'required|integer',
             'account_number' =>'integer'
           
        ];


    }

    public function attributes()
    {
        return [
            'organization_id'              => __('organization'),
            'event_id'           => __('Event')
            ];
    }
}
