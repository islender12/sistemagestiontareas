<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // Puedes utilizar las reglas regex y not_in para validar la contraseña
        // y asegurarte de que no incluya la letra "ñ".
        /**
         * La regla regex:/^(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
         *  utiliza una expresión regular para validar que la contraseña
         * contiene al menos una letra mayúscula y un caracter especial,
         * y que tiene una longitud mínima de 8 caracteres.
         */
        return [
            'email' => 'required|email',
            'password' => [
                'required',
            ],
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Debes Ingresar un Correo',
            'email.email' => 'Ingresa un Correo Valido',
            'password.required' => 'Debes Ingresar una Contraseña',
        ];
    }
}
