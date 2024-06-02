<?php

namespace App\Rules;

use App\Models\Client;
use Illuminate\Contracts\Validation\Rule;

class EmailRule implements Rule
{
    protected $id_user;

    /**
     * The error messages.
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id_user = null)
    {
        $this->id_user = $id_user;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $valid = true;

        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $value)) {
            $this->messages[] = 'Informe um email válido!';
            $valid = false;
        }

        if (strlen($value) > 100) {
            $this->messages[] = "Limite de 100 caracteres atingido!";
            $valid = false;
        }

        if (Client::emailExists($value, $this->id)) {
            $this->messages[] = "Esse email já está sendo utilizado!";
            $valid = false;
        }

        return $valid;
    }

    /**
     * Get the validation error messages.
     *
     * @return string
     */
    public function message()
    {
        return implode(' ', $this->messages);
    }
}
