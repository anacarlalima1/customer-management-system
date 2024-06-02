<?php

namespace App\Services;

use App\Models\Client;
use App\Repositories\BaseCrudRepository;
use App\Repositories\FindRepository;

class ClientService
{
    protected $clientRepository, $clientRegistrationRepository;

    public function __construct()
    {
        $this->clientRepository = new FindRepository(new Client());
        $this->clientRegistrationRepository = new BaseCrudRepository(new Client());
    }

    public function getClients(?object $request = null): object
    {
        $selects = ['name', 'social_name', 'cpf', 'father_name', 'mother_name', 'phone', 'email'];
        $perPage = isset($request['page']) ? 20 : null;

        return $this->clientRepository->findBy([
            'selects' => $selects,
            'orderBy' => ['name' => 'asc'],
            'groupBy' => 'id',
            'perPage' => $perPage,
        ]);
    }
    public function getClientById(string $id): object
    {
        return $this->clientRepository->findBy([
            'selects' => ['name', 'social_name', 'cpf', 'father_name', 'mother_name', 'phone', 'email'],
            'filters' => ['id' => $id],
        ]);
    }
    public function addClient(object $request): bool
    {
        $data = [
            'name' => $request->name,
            'social_name' => $request->social_name,
            'cpf' => $request->cpf,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'created_at' => now(),
        ];

        return $this->clientRegistrationRepository->insertItens($data);
    }

    public function updateClient(object $request): bool
    {
        $data = [
            'name' => $request->name,
            'social_name' => $request->social_name,
            'cpf' => $request->cpf,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'update_at' => now(),
        ];

        return $this->clientRegistrationRepository->updateItens($data, $request['id']);
    }
}
