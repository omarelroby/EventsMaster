<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'image' => 'nullable|image',
            'name.en' => 'required|string',
            'name.ar' => 'required|string',
            'email' => 'required|email|unique:providers,email',
            'tel1' => 'required|numeric',
            'tel2' => 'nullable|numeric',
            'password' => 'nullable|required_without:_method|confirmed',
            'description.en' => 'required|string',
            'description.ar' => 'required|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'snapchat_url' => 'nullable|url',
            'address.ar'=> 'nullable|string',
            'address.en'=> 'nullable|string',
            'city_id'=> 'nullable|integer',

        ];
    }

    public function attributes()
    {
        return [
            'image'             => __('Image'),
            'name.en'           => __('Name in English'),
            'name.ar'           => __('Name in Arabic'),
            'email'             => __('Email'),
            'tel1'              => __('Phone 1'),
            'tel2'              => __('Phone 2'),
            'password'          => __('Password'),
            'description.en'    => __('Description in English'),
            'description.ar'    => __('Description in Arabic'),
            'facebook_url'      => __('Facebook URL'),
            'twitter_url'       => __('Twitter URL'),
            'instagram_url'     => __('Instagram URL'),
            'youtube_url'       => __('Youtube URL'),
            'snapchat_url'      => __('Snapchat URL'),
            'address'           => __('Address'),
            'city_id'           => __('City'),
        ];
    }
}
