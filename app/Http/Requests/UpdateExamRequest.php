<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\RequestBody(
 *     request="UpdateExamRequest",
 *     required=true,
 *     description="Dados para atualizar um exame",
 *     @OA\JsonContent(
 *         type="object",
 *         @OA\Property(property="name", type="string", description="Nome do exame"),
 *         @OA\Property(property="description", type="string", description="Descrição do exame"),
 *         @OA\Property(property="price", type="number", format="float", description="Preço do exame"),
 *         @OA\Property(property="duration", type="string", format="time", description="Duração do exame")
 *     )
 * )
 */
class UpdateExamRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'nullable|numeric|min:0',
            'duration' => 'nullable|date_format:H:i:s',
            'icon' => 'nullable|string',
            'color' => 'nullable|string',
        ];
    }
}
