<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;

class ClienteApiController extends Controller
{
    public function index($codigoEmpresa)
    {
        $clientes = Cliente::where('empresa', $codigoEmpresa)->get()->makeHidden('recnum');
        return response()->json(['clientes' => $clientes], 200);
    }

    public function store(Request $request, $codigoEmpresa)
    { try {
        $validator = \Validator::make($request->all(), [
            'codigo' => 'required|numeric|unique:clientes,codigo,NULL,id,empresa,' . $codigoEmpresa,
          
            'razao_social' => 'required|string|max:255',
            'tipo' => 'required|in:PJ,PF,pj,pf',
            'cpf_cnpj' => 'required|string|max:14',
            // Adicione outras validações conforme necessário
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

       
            
            $cliente = Cliente::create(array_merge($request->all(), ['empresa' => $codigoEmpresa]))->makeHidden('recnum');
            return response()->json(['cliente' => $cliente], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($codigoEmpresa, $codigoCliente)
    {
        $cliente = Cliente::where('empresa', $codigoEmpresa)->where('codigo', $codigoCliente)->first(['codigo', 'razao_social', 'tipo', 'cpf_cnpj', 'updated_at', 'created_at']);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente não encontrado.'], 404);
        }

        return response()->json(['cliente' => $cliente], 200);
    }

    public function update(Request $request, $codigoEmpresa, $codigoCliente)
    {
        
        try {
            $validator = \Validator::make($request->all(), [
                'codigo' => 'numeric|unique:clientes,codigo,' . $codigoCliente . ',codigo,empresa,' . $codigoEmpresa,
              
                'razao_social' => 'string|max:255',
                'tipo' => 'in:PJ,PF',
                'cpf_cnpj' => 'string|max:14',
                // Adicione outras validações conforme necessário
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $cliente = Cliente::where('empresa', $codigoEmpresa)->where('codigo', $codigoCliente)->first();

            if (!$cliente) {
                return response()->json(['error' => 'Cliente não encontrado.'], 404);
            }

            $updateData = array_filter($request->only(['codigo', 'razao_social', 'tipo', 'cpf_cnpj']));
            $cliente->update($updateData);

            $cliente = $cliente->fresh();

            $response = [
                'codigo' => $cliente->codigo,
                'razao_social' => $cliente->razao_social,
                'tipo' => $cliente->tipo,
                'cpf_cnpj' => $cliente->cpf_cnpj,
                'updated_at' => $cliente->updated_at,
                'created_at' => $cliente->created_at,
            ];

            return response()->json(['cliente' => $response], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($codigoEmpresa, $codigoCliente)
    {
        try {
            $cliente = Cliente::where('empresa', $codigoEmpresa)->where('codigo', $codigoCliente)->first();

            if (!$cliente) {
                return response()->json(['error' => 'Cliente não encontrado.'], 404);
            }

            $cliente->delete();
            return response()->json(['message' => 'Cliente excluído com sucesso!'], 202);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir o cliente.'], 500);
        }
    }
}
