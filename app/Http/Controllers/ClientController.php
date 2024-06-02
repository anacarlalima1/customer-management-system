<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
    public function getClients(Request $request): object
    {
        try {
            $clients = $this->clientService->getClients($request);

            return response()->json(['clients' => $clients]);
        } catch (\Exception $exception) {
            return response()->json([$exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }

    }
    public function getClientById(Request $request): object
    {
        try {
            $client = $this->clientService->getClientById($request['id']);

            return response()->json(['client' => $client]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function deleteClient(Request $request): object
    {
        try {
            $this->clientService->deleteClient($request['id']);

            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'exception' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function addClient(adicionarMunicipioRequest $request): object
    {
        try {
            $this->clientService->addClient($request);

            return response()->json(['success' => true, 'message' => 'Cliente adicionado com sucesso!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function updateClient(adicionarMunicipioRequest $request): object
    {
        try {
            $this->clientService->updateClient($request);

            return response()->json(['success' => true, 'message' => 'Cliente alterado com sucesso!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
