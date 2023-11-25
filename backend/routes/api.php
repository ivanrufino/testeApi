<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\EmpresaApiController;
use App\Http\Controllers\API\ClienteApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// Rotas para Cliente
/* Route::get('clientes/{codigoEmpresa}', [ClienteApiController::class, 'index']);

Route::get('clientes/{codigoEmpresa}', [ClienteApiController::class, 'index']);
Route::get('clientes/{codigoEmpresa}', [ClienteApiController::class, 'index']);
Route::get('clientes/{codigoEmpresa}', [ClienteApiController::class, 'index']);

// Rotas para Empresa
Route::get('empresas', [EmpresaApiController::class, 'index']);
Route::get('empresas/{codigo}', [EmpresaApiController::class, 'show']);
Route::post('empresas', [EmpresaApiController::class, 'store']);
Route::put('empresas/{codigo}', [EmpresaApiController::class, 'update']);
Route::delete('empresas/{codigo}', [EmpresaApiController::class, 'destroy']); */

Route::prefix('empresas')->group(function () {
    Route::get('/', [EmpresaApiController::class, 'index']);
    Route::post('/', [EmpresaApiController::class, 'store']);
    Route::get('/{codigo}', [EmpresaApiController::class, 'show']);
    Route::put('/{codigo}', [EmpresaApiController::class, 'update']);
    Route::delete('/{codigo}', [EmpresaApiController::class, 'destroy']);

    Route::prefix('{codigoEmpresa}/clientes')->group(function () {
        Route::get('/', [ClienteApiController::class, 'index']);
        Route::post('/', [ClienteApiController::class, 'store']);
        Route::get('/{codigoCliente}', [ClienteApiController::class, 'show']);
        Route::put('/{codigoCliente}', [ClienteApiController::class, 'update']);
        Route::delete('/{codigoCliente}', [ClienteApiController::class, 'destroy']);
    });
});