<?php

namespace App\Http\Requests;

use App\Rules\FechaVencimientoValida;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidarProyectoExistente;

class FormCrearTareaRequest extends FormRequest
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
        return [
            'tarea' => 'required|min:10',
            'descripcion' => 'required|min:25',
            'proyecto' => ['required', 'integer', new ValidarProyectoExistente],
            'fecha_asignacion' => 'required|date',
            'fecha_vencimiento' => ['required', 'date', new FechaVencimientoValida($this->input('fecha_asignacion'))]
        ];
    }
}
