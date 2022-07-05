<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
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
            'nombres' => 'required|alpha',
            'apellidos' => 'required|alpha',
            'email' => 'required|email:rfc,dns',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombres.required' => 'El campo de Nombre es requerido',
            'apellidos.required' => 'El campo de Apellido es requerido',
            'email.required' => 'El campo de Email es requerido',
        ];
    }
}
