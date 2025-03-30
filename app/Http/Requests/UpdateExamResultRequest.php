<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\RequestBody(
 *     request="UpdateExamResultRequest",
 *     required=true,
 *     description="Dados para atualizar um resultado de exame",
 *     @OA\JsonContent(
 *         type="object",
 *         @OA\Property(property="exam_scheduling_id", type="integer", description="ID do agendamento do exame"),
 *         @OA\Property(property="result", type="string", description="Resultado do exame"),
 *         @OA\Property(property="observations", type="string", description="Observações do exame"),
 *         @OA\Property(property="result_date", type="string", format="date", description="Data do resultado do exame")
 *     )
 * )
 */
class UpdateExamResultRequest extends FormRequest
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
            'exam_scheduling_id' => 'nullable|exists:exam_schedulings,id',
            'result' => 'nullable|string',
            'observations' => 'nullable|string',
            'result_date' => 'nullable|date',
        ];
    }
}
