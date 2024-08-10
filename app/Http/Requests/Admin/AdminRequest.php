<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest {

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
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'nullable|required_without:_method|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'image'             => __('Image'),
            'name'           => __('Name'),
            'email'             => __('Email'),
            'password'          => __('Password'),
        ];
    }
}
