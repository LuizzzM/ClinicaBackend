<?php

namespace App\Models;

use App\ExamSchedulingStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="ExamScheduling",
 *     type="object",
 *     title="Agendamento de Exame",
 *     description="Modelo de Agendamento de Exame",
 *     required={"client_id", "medic_id", "exam_id", "scheduled_date", "scheduled_time"},
 *     @OA\Property(property="id", type="integer", description="ID do agendamento do exame"),
 *     @OA\Property(property="client_id", type="integer", description="ID do cliente"),
 *     @OA\Property(property="medic_id", type="integer", description="ID do médico"),
 *     @OA\Property(property="exam_id", type="integer", description="ID do exame"),
 *     @OA\Property(property="scheduled_date", type="string", format="date", description="Data do agendamento"),
 *     @OA\Property(property="scheduled_time", type="string", format="time", description="Hora do agendamento"),
 *     @OA\Property(property="times_rescheduled", type="integer", description="Número de vezes reagendado"),
 *     @OA\Property(property="status", type="string", description="Status do agendamento"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Data de criação"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Data de atualização")
 * )
 */
class ExamScheduling extends Model
{
    /** @use HasFactory<\Database\Factories\ExamSchedulingFactory> */
    use HasFactory;

    protected $fillable = [
        'client_id',
        'exam_id',
        'medic_id',
        'scheduled_date',
        'scheduled_time',
        'times_rescheduled',
        'status',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    protected $appends = [
        'date_time_scheduled',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function medic()
    {
        return $this->belongsTo(Medic::class)->withTrashed();
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function result()
    {
        return $this->hasOne(ExamResult::class);
    }

    public function getDateTimeScheduledAttribute()
    {
        $date = $this->scheduled_date->format('d/m/Y');
        return $date . ' às ' . $this->scheduled_time;
    }
}
