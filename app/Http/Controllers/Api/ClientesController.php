<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function getClientes()
    {
        $clientes = Cliente::all();

        $this->logout(request());
        
        return response()->json($clientes);
    }

    public function getClienteById(Request $request)
    {
        $id = $request->get('id');

        // Verifica se o cliente existe
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $this->logout($request);

        return response()->json($cliente);
    }

    private function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso.'
        ]);
    }




}
