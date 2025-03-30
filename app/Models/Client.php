<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     schema="Client",
 *     type="object",
 *     title="Cliente",
 *     description="Modelo de Cliente",
 *     required={"name", "cpf", "birth_date", "email"},
 *     @OA\Property(property="id", type="integer", description="ID do cliente"),
 *     @OA\Property(property="name", type="string", description="Nome do cliente"),
 *     @OA\Property(property="cpf", type="string", description="CPF do cliente"),
 *     @OA\Property(property="birth_date", type="string", format="date", description="Data de nascimento do cliente"),
 *     @OA\Property(property="email", type="string", format="email", description="Email do cliente"),
 *     @OA\Property(property="phone", type="string", description="Telefone do cliente"),
 *     @OA\Property(property="address", type="string", description="Endereço do cliente"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Data de criação"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Data de atualização")
 * )
 */
class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'cpf',
        'birth_date',
        'email',
        'phone',
        'address',
    ];
    protected $casts = [
        'birth_date' => 'date',
    ];
    protected $hidden = [
        'deleted_at',
    ];
    protected $appends = [
        'age',
        'masked_cpf',
        'masked_phone',
        'masked_birth_date',
    ];
    public function getAgeAttribute()
    {
        return $this->birth_date ? now()->diff($this->birth_date)->y : null;
    }

    public function exams()
    {
        return $this->hasMany(ExamScheduling::class);
    }

    public function getMaskedCpfAttribute()
    {
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->cpf);
    }

    public function getMaskedPhoneAttribute()
    {
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $this->phone);
    }

    public function getMaskedBirthDateAttribute()
    {
        return $this->birth_date ? $this->birth_date->format('d/m/Y') : null;
    }
}
