<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FAQRequest extends FormRequest
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

            'question.en' => 'required|string',
            'question.ar' => 'required|string',
            'answer.en' => 'required|string',
            'answer.ar' => 'required|string',
        ];


    }

    public function attributes()
    {
        return [
            'question.en' => __('Question in English'),
            'question.ar' => __('Question in Arabic'),
            'answer.en' => __('Answer in English'),
            'answer.ar' => __('Answer in Arabic'),
        ];
    }
}
