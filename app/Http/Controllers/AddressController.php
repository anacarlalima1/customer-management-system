<?php

namespace App\Http\Controllers;

use App\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }
    public function getAddresses(Request $request): object
    {
        try {
            $addresses = $this->addressService->getAddresses($request);

            return response()->json(['addresses' => $addresses]);
        } catch (\Exception $exception) {
            return response()->json([$exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }

    }
    public function getAddressById(Request $request): object
    {
        try {
            $address = $this->addressService->getAddressById($request['id']);

            return response()->json(['address' => $address]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function inactivateCity(Request $request): object
    {
        try {
            $this->addressService->inactivateCity($request['id']);

            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'exception' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function addAddress(adicionarMunicipioRequest $request): object
    {
        try {
            $this->addressService->addAddress($request);

            return response()->json(['success' => true, 'message' => 'Endereço adicionado com sucesso!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function updateAddress(adicionarMunicipioRequest $request): object
    {
        try {
            $this->addressService->updateAddress($request);

            return response()->json(['success' => true, 'message' => 'Endereço alterado com sucesso!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
