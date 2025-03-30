<?php

namespace App\Http\Requests;

use App\ExamSchedulingStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\RequestBody(
 *     request="StoreExamSchedulingRequest",
 *     required=true,
 *     description="Dados para criar um agendamento de exame",
 *     @OA\JsonContent(
 *         type="object",
 *         @OA\Property(property="client_id", type="integer", description="ID do cliente"),
 *         @OA\Property(property="medic_id", type="integer", description="ID do médico"),
 *         @OA\Property(property="exam_id", type="integer", description="ID do exame"),
 *         @OA\Property(property="scheduled_date", type="string", format="date", description="Data do agendamento"),
 *         @OA\Property(property="scheduled_time", type="string", format="time", description="Hora do agendamento"),
 *         @OA\Property(property="status", type="string", description="Status do agendamento")
 *     )
 * )
 */
class StoreExamSchedulingRequest extends FormRequest
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
        $this->merge([
            'status' => $this->status ?? 'agendado',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required|exists:clients,id',
            'medic_id' => 'required|exists:medics,id',
            'exam_id' => 'required|exists:exams,id',
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required|date_format:H:i:s',
            'times_rescheduled' => 'nullable|integer|min:0',
            'status' => 'nullable|in:agendado,realizado,cancelado',
        ];
    }
}
