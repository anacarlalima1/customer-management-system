<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/clients', [ClientController::class, 'getClients']);
Route::get('/client/{id}', [ClientController::class, 'getClientById']);
Route::post('/add-client', [ClientController::class, 'addClient']);
Route::put('/update-client/{id}', [ClientController::class, 'updateClient']);
Route::delete('/delete-client/{id}', [ClientController::class, 'deleteClient']);

Route::get('/addresses', [AddressController::class, 'getAddresses']);
Route::get('/address/{id}', [AddressController::class, 'getAddressById']);
Route::post('/add-address', [AddressController::class, 'addAddress']);
Route::put('/update-address/{id}', [AddressController::class, 'updateAddress']);
Route::delete('/inactive-address/{id}', [AddressController::class, 'inactivateAddress']);
