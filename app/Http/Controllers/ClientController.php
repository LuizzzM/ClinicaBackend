<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/clients",
     *     summary="Listar clientes",
     *     description="Retorna uma lista de clientes",
     *     tags={"Clientes"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de clientes",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Client"))
     *     )
     * )
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *     path="/api/clients",
     *     summary="Criar cliente",
     *     description="Cria um novo cliente",
     *     tags={"Clientes"},
     *     @OA\RequestBody(ref="#/components/requestBodies/StoreClientRequest"),
     *     @OA\Response(
     *         response=201,
     *         description="Cliente criado",
     *         @OA\JsonContent(ref="#/components/schemas/Client")
     *     )
     * )
     */
    public function store(StoreClientRequest $request)
    {
        $client = Client::create($request->validated());
        return response()->json($client, Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/api/clients/{id}",
     *     summary="Exibir cliente",
     *     description="Retorna os dados de um cliente específico",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do cliente",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do cliente",
     *         @OA\JsonContent(ref="#/components/schemas/Client")
     *     )
     * )
     */
    public function show(Client $client)
    {
        $client->load('exams');
        return response()->json($client, Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *     path="/api/clients/{id}",
     *     summary="Atualizar cliente",
     *     description="Atualiza os dados de um cliente específico",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do cliente",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/UpdateClientRequest"),
     *     @OA\Response(
     *         response=200,
     *         description="Cliente atualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Client")
     *     )
     * )
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        return response()->json($client, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *     path="/api/clients/{id}",
     *     summary="Excluir cliente",
     *     description="Exclui um cliente específico",
     *     tags={"Clientes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do cliente",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Cliente excluído"
     *     )
     * )
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
