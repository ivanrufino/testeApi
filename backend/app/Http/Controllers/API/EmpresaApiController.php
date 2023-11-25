<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaApiController extends Controller
{
    public function index()
    {
//        $empresas = Empresa::all()->makeHidden('recnum');
        $empresas = Empresa::orderBy('sigla', 'desc')->get()->makeHidden('recnum');

        return response()->json(['empresas' => $empresas], 200);
    }


    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'codigo' => 'required|numeric|size:9999|unique:empresas',
            'empresa' => 'required|numeric',
            'sigla' => 'required|string|max:40',
            'razao_social' => 'required|string|max:255',

        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $empresa = Empresa::create($request->all(['codigo', 'empresa', 'sigla', 'razao_social', 'updated_at', 'created_at']))->makeHidden('recnum');
            return response()->json(['empresa' => $empresa], 201);

        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->json(['error' => ['Erro inesperado. favor tente mais tarde.']], 500);
        }
    }

    public function show($codigo)
    {
        $empresa = Empresa::where('codigo', $codigo)->first(['codigo', 'empresa', 'sigla', 'razao_social', 'updated_at', 'created_at']);

        if (!$empresa) {
            return response()->json(['error' => 'Empresa não encontrada.'], 404);
        }

        return response()->json(['empresa' => $empresa], 200);
    }


    public function update(Request $request, $codigo)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'codigo' => 'numeric|max:9999|unique:empresas,codigo,' . $codigo . ',codigo',
                'empresa' => 'numeric',
                'sigla' => 'string|max:40',
                'razao_social' => 'string|max:255',
                // Adicione outras validações conforme necessário
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $empresa = Empresa::where('codigo', $codigo)->first();

            if (!$empresa) {
                return response()->json(['error' => 'Empresa não encontrada.'], 404);
            }
            $updateData = array_filter($request->only(['codigo', 'empresa', 'sigla', 'razao_social']));
            $empresa->update($updateData);

            $empresa = $empresa->fresh();

            $response = [
                'codigo' => $empresa->codigo,
                'empresa' => $empresa->empresa,
                'sigla' => $empresa->sigla,
                'razao_social' => $empresa->razao_social,
                'updated_at' => $empresa->updated_at,
                'created_at' => $empresa->created_at,
            ];

            return response()->json(['empresa' => $response], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
            //return response()->json(['error' => ['Erro inesperado. favor tente mais tarde.']], 500);

        }
    }

    public function destroy($codigo)
    {
        try {
            $empresa = Empresa::where('codigo', $codigo)->first();

            if (!$empresa) {
                return response()->json(['error' => 'Empresa não encontrada.'], 404);
            }

            $empresa->delete();
            return response()->json(['message' => 'Empresa excluída com sucesso!'], 202);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir a empresa.'], 500);
        }
    }
}


