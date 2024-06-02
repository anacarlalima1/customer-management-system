<?php

namespace App\Services;
use App\Models\Address;

use App\Repositories\BaseCrudRepository;
use App\Repositories\FindRepository;

class AddressService
{
    protected $addressRepository, $addressRegistrationRepository;

    public function __construct()
    {
        $this->addressRepository = new FindRepository(new Address());
        $this->addressRegistrationRepository = new BaseCrudRepository(new Address());
    }

    public function getAddresses(?object $request = null): object
    {
        $selects = ['type', 'cep', 'street', 'number', 'complement', 'district', 'state', 'city', 'client_id'];
        $perPage = isset($request['page']) ? 20 : null;
        $withTrashed = isset($request['includeTrashed']) ? $request['includeTrashed'] : false;

        return $this->addressRepository->findBy([
            'selects' => $selects,
            'orderBy' => ['street' => 'asc'],
            'groupBy' => 'id',
            'perPage' => $perPage,
            'withTrashed' => $withTrashed
        ]);
    }
    public function getAddressById(string $id): object
    {
        return $this->addressRepository->findBy([
            'selects' => ['type', 'cep', 'street', 'number', 'complement', 'district', 'state', 'city', 'client_id'],
            'filters' => ['id' => $id],
        ]);
    }
    public function addAddress(object $request): bool
    {
        $data = [
            'type' => $request->type,
            'cep' => $request->cep,
            'street' => $request->street,
            'number' => $request->number,
            'complement' => $request->complement,
            'district' => $request->district,
            'state' => $request->state,
            'city' => $request->city,
            'created_at' => now(),
        ];

        return $this->addressRegistrationRepository->insertItens($data);
    }

    public function updateAddress(object $request): bool
    {
        $data = [
            'type' => $request->type,
            'cep' => $request->cep,
            'street' => $request->street,
            'number' => $request->number,
            'complement' => $request->complement,
            'district' => $request->district,
            'state' => $request->state,
            'city' => $request->city,
            'update_at' => now(),
        ];

        return $this->addressRegistrationRepository->updateItens($data, $request['id']);
    }
}
