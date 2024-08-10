<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventImageRequest extends FormRequest
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
            'event_id' => 'required|integer',
            'url' => 'required|image',
        ];


    }

    public function attributes()
    {
        return [
            'event_id'              => __('Event'),
            'url'                => __('Url'),
        ];
    }
}
