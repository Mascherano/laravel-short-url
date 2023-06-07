<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterApiRequest extends FormRequest
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
            'name'          => ['required', 'regex:/^[\pL\s\-]+$/u'],
            'email'         => ['required', 'email', 'unique:users,email'],
            'password'      => ['required', 'string', 'min:6', 'max:20', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-.]).{6,}$/'],
        ];

    }

    public function messages(): array
    {
        return [
            'name.required' => 'El :attribute es requerido.',
            'name.regex'    => 'El :attribute debe ser una cadena de caracteres.',
            
            'email.required'    => 'El :attribute es requerido.',
            'email.email'       => 'El :attribute no tiene un formato válido.',
            'email.unique'      => 'El :attribute debe ser único en nuestros registros.',

            'password.required' => 'El :attribute es requerido.',
            'password.min'      => 'El :attribute debe tener como mínimo :min caracteres.',
            'password.max'      => 'El :attribute debe tener como máximo :max caracteres.',
            'password.regex'    => 'El :attribute debe tener una al menos una letra en mayúsculas, una en minúsculas, un número y un caracter especia ej: (#?!@$%^&*-.)'
        ];
    }
}
