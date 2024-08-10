<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventItemRequest extends FormRequest
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
            'title' => 'required',
             'event_id' => 'required|integer'
           
        ];


    }

    public function attributes()
    {
        return [
            'title'              => __('Title'),
            'event_id'           => __('Event')
            ];
    }
}
