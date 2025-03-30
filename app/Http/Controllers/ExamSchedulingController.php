<?php

namespace App\Http\Controllers;

use App\Models\ExamScheduling;
use App\Http\Requests\StoreExamSchedulingRequest;
use App\Http\Requests\UpdateExamSchedulingRequest;
use Symfony\Component\HttpFoundation\Response;

class ExamSchedulingController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/exam-schedulings",
     *     summary="Listar agendamentos de exames",
     *     description="Retorna uma lista de agendamentos de exames",
     *     tags={"Agendamentos de Exames"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de agendamentos de exames",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ExamScheduling"))
     *     )
     * )
     */
    public function index()
    {
        $examSchedulings = ExamScheduling::all();
        return response()->json($examSchedulings, Response::HTTP_OK);
    }


    /**
     * @OA\Post(
     *     path="/api/exam-schedulings",
     *     summary="Criar agendamento de exame",
     *     description="Cria um novo agendamento de exame",
     *     tags={"Agendamentos de Exames"},
     *     @OA\RequestBody(ref="#/components/requestBodies/StoreExamSchedulingRequest"),
     *     @OA\Response(
     *         response=201,
     *         description="Agendamento de exame criado",
     *         @OA\JsonContent(ref="#/components/schemas/ExamScheduling")
     *     )
     * )
     */
    public function store(StoreExamSchedulingRequest $request)
    {
        $examScheduling = ExamScheduling::create($request->validated());
        return response()->json($examScheduling, Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/api/exam-schedulings/{id}",
     *     summary="Exibir agendamento de exame",
     *     description="Retorna os dados de um agendamento de exame específico",
     *     tags={"Agendamentos de Exames"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do agendamento de exame",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do agendamento de exame",
     *         @OA\JsonContent(ref="#/components/schemas/ExamScheduling")
     *     )
     * )
     */
    public function show(ExamScheduling $examScheduling)
    {
        $examScheduling->load(['client', 'medic', 'exam', 'result']);
        return response()->json($examScheduling, Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/api/exam-schedulings/{id}",
     *     summary="Atualizar agendamento de exame",
     *     description="Atualiza os dados de um agendamento de exame específico",
     *     tags={"Agendamentos de Exames"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do agendamento de exame",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/UpdateExamSchedulingRequest"),
     *     @OA\Response(
     *         response=200,
     *         description="Agendamento de exame atualizado",
     *         @OA\JsonContent(ref="#/components/schemas/ExamScheduling")
     *     )
     * )
     */
    public function update(UpdateExamSchedulingRequest $request, ExamScheduling $examScheduling)
    {
        $examScheduling->update($request->validated());
        return response()->json($examScheduling, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     path="/api/exam-schedulings/{id}",
     *     summary="Excluir agendamento de exame",
     *     description="Exclui um agendamento de exame específico",
     *     tags={"Agendamentos de Exames"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do agendamento de exame",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Agendamento de exame excluído"
     *     )
     * )
     */
    public function destroy(ExamScheduling $examScheduling)
    {
        $examScheduling->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function checkAvailability(string $date, string $time)
    {
        //Validar se é uma data YYYT-MM-DD
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return response()->json(['error' => 'Invalid date format'], Response::HTTP_BAD_REQUEST);
        }
        
        // Verifica se já existe um agendamento para a data informada
        $examScheduling = ExamScheduling::whereDate('scheduled_date', $date)
            ->whereTime('scheduled_time', $time)
            ->where('status', 'agendado')
            ->exists();

        // Se já existe, retorna false
        return response()->json(['available' => !$examScheduling], Response::HTTP_OK);
    }
}
