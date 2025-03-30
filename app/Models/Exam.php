<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Exam",
 *     type="object",
 *     title="Exame",
 *     description="Modelo de Exame",
 *     required={"name", "description"},
 *     @OA\Property(property="id", type="integer", description="ID do exame"),
 *     @OA\Property(property="name", type="string", description="Nome do exame"),
 *     @OA\Property(property="description", type="string", description="Descrição do exame"),
 *     @OA\Property(property="price", type="number", format="float", description="Preço do exame"),
 *     @OA\Property(property="duration", type="string", format="time", description="Duração do exame"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Data de criação"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Data de atualização")
 * )
 */
class Exam extends Model
{
    /** @use HasFactory<\Database\Factories\ExamFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'icon',
        'color',
];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function schedules()
    {
        return $this->hasMany(ExamScheduling::class);
    }




}
