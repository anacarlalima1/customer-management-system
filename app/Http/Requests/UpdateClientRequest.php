<?php

namespace App\Http\Requests;

use App\Rules\EmailRule;
use App\Rules\NameRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', new NameRule()],
            'social_name' => ['nullable', new NameRule()],
            'cpf' => ['required', 'string', 'max:14', 'unique:clients,cpf,'],
            'father_name' => ['nullable', new NameRule()],
            'mother_name' => ['nullable', new NameRule()],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', new EmailRule(), 'unique:clients,email,' ],
        ];
    }
    public function messages()
    {
        return [
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.string' => 'O CPF deve ser uma string.',
            'cpf.max' => 'O CPF não pode ter mais que 14 caracteres.',
            'cpf.unique' => 'Este CPF já está cadastrado no sistema.',
            'phone.string' => 'O telefone deve ser uma string.',
            'phone.max' => 'O telefone não pode ter mais que 20 caracteres.',
        ];
    }
}
