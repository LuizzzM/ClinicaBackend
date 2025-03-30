<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\RequestBody(
 *     request="UpdateMedicRequest",
 *     required=true,
 *     description="Dados para atualizar um médico",
 *     @OA\JsonContent(
 *         type="object",
 *         @OA\Property(property="name", type="string", description="Nome do médico"),
 *         @OA\Property(property="email", type="string", format="email", description="Email do médico"),
 *         @OA\Property(property="phone", type="string", description="Telefone do médico"),
 *         @OA\Property(property="speciality", type="string", description="Especialidade do médico"),
 *         @OA\Property(property="crm", type="string", description="CRM do médico")
 *     )
 * )
 */
class UpdateMedicRequest extends FormRequest
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
        if ($this->has('crm')) {
            $this->merge([
                'crm' => preg_replace('/[^0-9]/', '', $this->crm),
            ]);
        }
        if ($this->has('phone')) {
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
            'email' => 'nullable|email|max:255|unique:medics,email,' . $this->route('medic'),
            'phone' => 'nullable|string|max:15|regex:/^[0-9]+$/',
            'speciality' => 'nullable|string|max:255',
            'crm' => 'nullable|string|size:6|unique:medics,crm,' . $this->route('medic') . '|regex:/^[0-9]+$/',
        ];
    }
}
