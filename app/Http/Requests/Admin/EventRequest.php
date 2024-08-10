<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'email'  => 'required',
             'city_id' => 'required|integer'
           
        ];


    }

    public function attributes()
    {
        return [
            'title'              => __('Title'),
            'email'                => __('Email'),
            'city_id'           => __('City')
         
        ];
    }
}
