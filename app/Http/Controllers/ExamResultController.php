<?php

namespace App\Http\Controllers;

use App\ExamSchedulingStatusEnum;
use App\Models\ExamResult;
use App\Http\Requests\StoreExamResultRequest;
use App\Http\Requests\UpdateExamResultRequest;
use Symfony\Component\HttpFoundation\Response;

class ExamResultController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/exam-results",
     *     summary="Listar resultados de exames",
     *     description="Retorna uma lista de resultados de exames",
     *     tags={"Resultados de Exames"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de resultados de exames",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ExamResult"))
     *     )
     * )
     */
    public function index()
    {
        $examResults = ExamResult::all();
        return response()->json($examResults, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/exam-results",
     *     summary="Criar resultado de exame",
     *     description="Cria um novo resultado de exame",
     *     tags={"Resultados de Exames"},
     *     @OA\RequestBody(ref="#/components/requestBodies/StoreExamResultRequest"),
     *     @OA\Response(
     *         response=201,
     *         description="Resultado de exame criado",
     *         @OA\JsonContent(ref="#/components/schemas/ExamResult")
     *     )
     * )
     */
    public function store(StoreExamResultRequest $request)
    {
        $examResult = ExamResult::create($request->validated());
        $scheduling = $examResult->scheduling;
        $scheduling->update([
            'status' => ExamSchedulingStatusEnum::COMPLETED,
        ]);
        return response()->json($examResult, Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/api/exam-results/{id}",
     *     summary="Exibir resultado de exame",
     *     description="Retorna os dados de um resultado de exame específico",
     *     tags={"Resultados de Exames"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do resultado de exame",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do resultado de exame",
     *         @OA\JsonContent(ref="#/components/schemas/ExamResult")
     *     )
     * )
     */
    public function show(ExamResult $examResult)
    {
        return response()->json($examResult, Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/api/exam-results/{id}",
     *     summary="Atualizar resultado de exame",
     *     description="Atualiza os dados de um resultado de exame específico",
     *     tags={"Resultados de Exames"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do resultado de exame",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/UpdateExamResultRequest"),
     *     @OA\Response(
     *         response=200,
     *         description="Resultado de exame atualizado",
     *         @OA\JsonContent(ref="#/components/schemas/ExamResult")
     *     )
     * )
     */
    public function update(UpdateExamResultRequest $request, ExamResult $examResult)
    {
        $examResult->update($request->validated());
        return response()->json($examResult, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     path="/api/exam-results/{id}",
     *     summary="Excluir resultado de exame",
     *     description="Exclui um resultado de exame específico",
     *     tags={"Resultados de Exames"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do resultado de exame",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Resultado de exame excluído"
     *     )
     * )
     */
    public function destroy(ExamResult $examResult)
    {
        $examResult->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
