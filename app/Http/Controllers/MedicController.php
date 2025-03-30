<?php

namespace App\Http\Controllers;

use App\Models\Medic;
use App\Http\Requests\StoreMedicRequest;
use App\Http\Requests\UpdateMedicRequest;
use Symfony\Component\HttpFoundation\Response;

class MedicController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/medics",
     *     summary="Listar médicos",
     *     description="Retorna uma lista de médicos",
     *     tags={"Médicos"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de médicos",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Medic"))
     *     )
     * )
     */
    public function index()
    {
        $medics = Medic::all();
        return response()->json($medics, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/medics",
     *     summary="Criar médico",
     *     description="Cria um novo médico",
     *     tags={"Médicos"},
     *     @OA\RequestBody(ref="#/components/requestBodies/StoreMedicRequest"),
     *     @OA\Response(
     *         response=201,
     *         description="Médico criado",
     *         @OA\JsonContent(ref="#/components/schemas/Medic")
     *     )
     * )
     */
    public function store(StoreMedicRequest $request)
    {
        $medic = Medic::create($request->validated());
        return response()->json($medic, Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/api/medics/{id}",
     *     summary="Exibir médico",
     *     description="Retorna os dados de um médico específico",
     *     tags={"Médicos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do médico",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do médico",
     *         @OA\JsonContent(ref="#/components/schemas/Medic")
     *     )
     * )
     */
    public function show(Medic $medic)
    {
        $medic->load('exams');
        return response()->json($medic, Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/api/medics/{id}",
     *     summary="Atualizar médico",
     *     description="Atualiza os dados de um médico específico",
     *     tags={"Médicos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do médico",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/UpdateMedicRequest"),
     *     @OA\Response(
     *         response=200,
     *         description="Médico atualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Medic")
     *     )
     * )
     */
    public function update(UpdateMedicRequest $request, Medic $medic)
    {
        $medic->update($request->validated());
        return response()->json($medic, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     path="/api/medics/{id}",
     *     summary="Excluir médico",
     *     description="Exclui um médico específico",
     *     tags={"Médicos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do médico",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Médico excluído"
     *     )
     * )
     */
    public function destroy(Medic $medic)
    {
        $medic->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
