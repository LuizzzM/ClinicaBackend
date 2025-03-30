<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     schema="Medic",
 *     type="object",
 *     title="Médico",
 *     description="Modelo de Médico",
 *     required={"name", "email", "crm"},
 *     @OA\Property(property="id", type="integer", description="ID do médico"),
 *     @OA\Property(property="name", type="string", description="Nome do médico"),
 *     @OA\Property(property="email", type="string", format="email", description="Email do médico"),
 *     @OA\Property(property="phone", type="string", description="Telefone do médico"),
 *     @OA\Property(property="speciality", type="string", description="Especialidade do médico"),
 *     @OA\Property(property="crm", type="string", description="CRM do médico"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Data de criação"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Data de atualização")
 * )
 */
class Medic extends Model
{
    /** @use HasFactory<\Database\Factories\MedicFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'speciality',
        'crm',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    protected $appends = [
        'masked_phone',
        'masked_crm',
    ];

    public function exams()
    {
        return $this->hasMany(ExamScheduling::class, 'medic_id', 'id');
    }

    public function getMaskedPhoneAttribute()
    {
        return $this->phone ? preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $this->phone) : null;
    }
    public function getMaskedCrmAttribute()
    {
        return $this->crm ? preg_replace('/(\d{2})(\d{4})(\d{4})/', '$1.$2-$3', $this->crm) : null;
    }

}
