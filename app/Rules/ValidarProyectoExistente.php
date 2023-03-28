<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidarProyectoExistente implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $proyecto = DB::table('proyectos')->select('id')->where('id', $value)->first();

        if (!$proyecto) {
            $fail('El :attribute No existe');
        }
    }
}
