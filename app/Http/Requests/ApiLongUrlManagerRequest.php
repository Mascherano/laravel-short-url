<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiLongUrlManagerRequest extends FormRequest
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
            'url' => ['required', 'url', 'unique:short_urls,url'],
        ];
    }

    public function messages(): array
    {
        return [
            'url.required'  => 'La :attribute es requerida.',
            'url.url'       => 'La :attribute debe tener un formato válido.',
            'url.unique'    => 'La :attribute debe ser única en nuestros registros.',
        ];
    }
}
