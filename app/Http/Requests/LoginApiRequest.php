<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginApiRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'     => ['required', 'email'],
            'password'  => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            
            'email.required'    => 'El :attribute es requerido.',
            'email.email'       => 'El :attribute no tiene un formato válido.',

            'password.required' => 'El :attribute es requerido.',

        ];
    }
}
