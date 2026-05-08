<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class QueriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'nombre' => 'required|string|max:30',
            'email' => 'required|email',
            'asunto' => 'required',
            'mensaje' => 'required|string|min:10|max:500'
        ];
    }
    #[Override]
    public function messages(): array
    {
        return [
            'nombre.required' => 'Debe ingresar su nombre.',
            'nombre.max' => 'Se admiten 30 caracteres como máximo.',
            'email.email' => 'Se requiere un email válido.',
            'email.required' => 'Debe ingresar un e-mail de contacto.',
            'asunto.required'=> 'Debe seleccionar un asunto.',
            'mensaje.min' => 'El mensaje es muy breve.',
            'mensaje.max' => 'Se admiten 500 caracteres como máximo.',
            'mensaje.required' => 'Debe escribir un mensaje.'
        ];
    }
}
