<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="ExamResult",
 *     type="object",
 *     title="Resultado de Exame",
 *     description="Modelo de Resultado de Exame",
 *     required={"exam_scheduling_id", "result", "result_date"},
 *     @OA\Property(property="id", type="integer", description="ID do resultado do exame"),
 *     @OA\Property(property="exam_scheduling_id", type="integer", description="ID do agendamento do exame"),
 *     @OA\Property(property="result", type="string", description="Resultado do exame"),
 *     @OA\Property(property="observations", type="string", description="Observações do exame"),
 *     @OA\Property(property="result_date", type="string", format="date", description="Data do resultado do exame"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Data de criação"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Data de atualização")
 * )
 */
class ExamResult extends Model
{
    /** @use HasFactory<\Database\Factories\ExamResultFactory> */
    use HasFactory;

    protected $fillable = [
        'exam_scheduling_id',
        'result',
        'observations',
        'result_date',
    ];
    protected $casts = [
        'result_date' => 'date',
    ];

    protected $appends = [
        'masked_result_date',
    ];
    public function getMaskedResultDateAttribute()
    {
        return $this->result_date ? $this->result_date->format('d/m/Y') : null;
    }
    public function scheduling()
    {
        return $this->belongsTo(ExamScheduling::class, 'exam_scheduling_id');
    }
}
