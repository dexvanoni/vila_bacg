<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidCpf implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
         // Remover caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $value);

        // Verificar se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Evitar números sequenciais, que são inválidos
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Cálculo dos dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O CPF informado é inválido na Receita Federal do Brasil.';
    }
}
