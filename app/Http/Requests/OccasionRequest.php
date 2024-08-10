<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OccasionRequest extends FormRequest
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

            'name' => 'required|max:255',
//            'user_id' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required',
            'description' => 'required|string',

        ];


    }

    public function attributes()
    {
        return [
            'name'              => __('Name'),
            'date'                => __('Date'),
            'time'           => __('Time'),
            'description'       => __('Description'),
        ];
    }
}
