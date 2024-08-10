<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
            "name"            => 'required|string',
            "email"                 => 'required|email|unique:users,email,'. Auth::user()->id
        ];


    }

    public function attributes()
    {
        return [
            'name' => __('Name'),
            'email' => __('Email'),
        ];
    }
}
