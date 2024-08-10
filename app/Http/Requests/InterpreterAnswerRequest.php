<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterpreterAnswerRequest extends FormRequest
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

            "interpreter_answer"            => 'required|string',
            "interpreter_answer2"            => 'required|string',
        ];


    }

    public function attributes()
    {
        return [
            'interpreter_answer' => __('Interpreter answer'),
            'interpreter_answer2' => __('Interpreter answer 2'),
        ];
    }
}
