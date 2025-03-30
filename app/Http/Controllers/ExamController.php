<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use Symfony\Component\HttpFoundation\Response;

class ExamController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/exams",
     *     summary="Listar exames",
     *     description="Retorna uma lista de exames",
     *     tags={"Exames"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de exames",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Exam"))
     *     )
     * )
     */
    public function index()
    {
        $exams = Exam::all();
        return response()->json($exams, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/exams",
     *     summary="Criar exame",
     *     description="Cria um novo exame",
     *     tags={"Exames"},
     *     @OA\RequestBody(ref="#/components/requestBodies/StoreExamRequest"),
     *     @OA\Response(
     *         response=201,
     *         description="Exame criado",
     *         @OA\JsonContent(ref="#/components/schemas/Exam")
     *     )
     * )
     */
    public function store(StoreExamRequest $request)
    {
        $exam = Exam::create($request->validated());
        return response()->json($exam, Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/api/exams/{id}",
     *     summary="Exibir exame",
     *     description="Retorna os dados de um exame específico",
     *     tags={"Exames"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do exame",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do exame",
     *         @OA\JsonContent(ref="#/components/schemas/Exam")
     *     )
     * )
     */
    public function show(Exam $exam)
    {
        $exam->load('schedules', 'schedules.client', 'schedules.medic', 'schedules.result');
        return response()->json($exam, Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/api/exams/{id}",
     *     summary="Atualizar exame",
     *     description="Atualiza os dados de um exame específico",
     *     tags={"Exames"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do exame",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/UpdateExamRequest"),
     *     @OA\Response(
     *         response=200,
     *         description="Exame atualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Exam")
     *     )
     * )
     */
    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $exam->update($request->validated());
        return response()->json($exam, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     path="/api/exams/{id}",
     *     summary="Excluir exame",
     *     description="Exclui um exame específico",
     *     tags={"Exames"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do exame",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Exame excluído"
     *     )
     * )
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
