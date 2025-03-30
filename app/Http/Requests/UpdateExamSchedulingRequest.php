<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\RequestBody(
 *     request="UpdateExamSchedulingRequest",
 *     required=true,
 *     description="Dados para atualizar um agendamento de exame",
 *     @OA\JsonContent(
 *         type="object",
 *         @OA\Property(property="client_id", type="integer", description="ID do cliente"),
 *         @OA\Property(property="medic_id", type="integer", description="ID do médico"),
 *         @OA\Property(property="exam_id", type="integer", description="ID do exame"),
 *         @OA\Property(property="scheduled_date", type="string", format="date", description="Data do agendamento"),
 *         @OA\Property(property="scheduled_time", type="string", format="time", description="Hora do agendamento"),
 *         @OA\Property(property="times_rescheduled", type="integer", description="Número de vezes reagendado"),
 *         @OA\Property(property="status", type="string", description="Status do agendamento")
 *     )
 * )
 */
class UpdateExamSchedulingRequest extends FormRequest
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
            'client_id' => 'nullable|exists:clients,id',
            'medic_id' => 'nullable|exists:medics,id',
            'exam_id' => 'nullable|exists:exams,id',
            'scheduled_date' => 'nullable|date',
            'scheduled_time' => 'nullable|date_format:H:i:s',
            'times_rescheduled' => 'nullable|integer|min:0',
            'status' => 'nullable|string|in:agendado,realizado,cancelado',
        ];
    }
}
