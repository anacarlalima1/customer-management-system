<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NameRule implements Rule
{
    /**
     * The error message.
     *
     * @var array
     */
    protected $messages = [];

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
    // Contempla nome e título
    public function passes($attribute, $value)
    {
        $valid = true;

        if (!is_string($value)) {
            $this->messages[] = "$attribute deve ser do tipo texto!";
            $valid = false;
        }

        $length = strlen($value);
        if ($length < 3) {
            $this->messages[] = "Mínimo de 3 caracteres não atingido!";
            $valid = false;
        }

        if ($length > 255) {
            $this->messages[] = "Limite de 255 caracteres atingido!";
            $valid = false;
        }

        return $valid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return implode(' ', $this->messages);
    }
}
