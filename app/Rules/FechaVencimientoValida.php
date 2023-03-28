<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FechaVencimientoValida implements ValidationRule
{
    private $fecha_asignacion;

    public function __construct($fecha_asignacion)
    {
        $this->fecha_asignacion = $fecha_asignacion;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $fecha_vencimiento = strtotime($value);
        $fecha_asignacion = strtotime($this->fecha_asignacion);
        if ($fecha_vencimiento < $fecha_asignacion) {
            $fail("La Fecha de Vencimiento no Puede ser Menor a la de Asignacion");
        }
    }
}
