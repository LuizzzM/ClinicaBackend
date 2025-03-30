<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\RequestBody(
 *     request="UpdateClientRequest",
 *     required=true,
 *     description="Dados para atualizar um cliente",
 *     @OA\JsonContent(
 *         type="object",
 *         @OA\Property(property="name", type="string", description="Nome do cliente"),
 *         @OA\Property(property="cpf", type="string", description="CPF do cliente"),
 *         @OA\Property(property="birth_date", type="string", format="date", description="Data de nascimento do cliente"),
 *         @OA\Property(property="email", type="string", format="email", description="Email do cliente"),
 *         @OA\Property(property="phone", type="string", description="Telefone do cliente"),
 *         @OA\Property(property="address", type="string", description="Endereço do cliente")
 *     )
 * )
 */
class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        if($this->has('cpf')) {
            $this->merge([
                'cpf' => preg_replace('/[^0-9]/', '', $this->cpf),
            ]);
        }
        if($this->has('phone')) {
            $this->merge([
                'phone' => preg_replace('/[^0-9]/', '', $this->phone),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'cpf' => 'nullable|string|size:11|unique:clients,cpf,' . $this->route('client')->id . '|regex:/^[0-9]+$/',
            'birth_date' => 'nullable|date|date_format:Y-m-d|before:today',
            'email' => 'nullable|email|max:255|unique:clients,email,' . $this->route('client')->id,
            'phone' => 'nullable|string|max:15|regex:/^[0-9]+$/',
            'address' => 'nullable|string|max:255',
        ];
    }
}
