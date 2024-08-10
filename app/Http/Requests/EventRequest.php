<?php

namespace App\Http\Requests;

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

            'from' => 'required|date',
            'to' => 'required|date',
            'city_id' => 'required|integer',
            'provider_id' => 'required|integer',
            'address.en' => 'required|string',
            'address.ar' => 'required|string',
            'about.en' => 'required|string',
            'about.ar' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ];


    }

    public function attributes()
    {
        return [
            'from'              => __('From'),
            'to'                => __('To'),
            'city_id'           => __('City'),
            'provider_id'       => __('Provider'),
            'address.en'        => __('Address in English'),
            'address.ar'        => __('Address in Arabic'),
            'about.en'          => __('About event in English'),
            'about.ar'          => __('About event in Arabic'),
            'lat'               => __('Latitude'),
            'lng'               => __('Longitude'),
        ];
    }
}
