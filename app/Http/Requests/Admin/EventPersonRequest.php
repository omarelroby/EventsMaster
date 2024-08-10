<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventPersonRequest extends FormRequest
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
            'person_id' => 'required',
             'event_id' => 'required|integer'
           
        ];


    }

    public function attributes()
    {
        return [
            'person_id'              => __('Person'),
            'event_id'           => __('Event')
            ];
    }
}
