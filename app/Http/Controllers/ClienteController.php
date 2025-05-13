<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
           
            $data = Cliente::latest()->get();
            
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtns = '
                        <a href="' . route("cliente.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                        
                        <form action="' . route("cliente.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-outline-danger btn-sm ml-2")><i class="fas fa-trash"></i></button>
                        </form>
                    ';
                    return $actionBtns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.crud');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        
        $nome = $request->post('nome');
        $cpf = $request->post('cpf');
        $cep = $request->post('cep');
        $logradouro = $request->post('logradouro');
        $numero = $request->post('numero');
        $complemento = $request->post('complemento');
        $bairro = $request->post('bairro');
        $cidade = $request->post('cidade');
        $uf = $request->post('uf');
        $celular = $request->post('celular');
        $email = $request->post('email');
        

        $cliente = new Cliente();

        $cliente->nome = $nome;
        $cliente->cpf = $cpf;
        $cliente->cep = $cep;
        $cliente->logradouro = $logradouro;
        $cliente->numero = $numero;
        $cliente->complemento = $complemento;
        $cliente->bairro = $bairro;
        $cliente->cidade = $cidade;
        $cliente->uf = $uf;
        $cliente->celular = $celular;
        $cliente->email = $email;
        $cliente->origin_user = $user->name;
        $cliente->last_user = $user->name;
        $cliente->save();


        return view('clientes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edit = Cliente::find($id);

        $output = array(
            'edit' => $edit,
        );

        return view('clientes.crud', $output);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $nome = $request->post('nome');
        $cpf = $request->post('cpf');
        $cep = $request->post('cep');
        $logradouro = $request->post('logradouro');
        $numero = $request->post('numero');
        $complemento = $request->post('complemento');
        $bairro = $request->post('bairro');
        $cidade = $request->post('cidade');
        $uf = $request->post('uf');
        $celular = $request->post('celular');
        $email = $request->post('email');

        $cliente = Cliente::find($id);

        $cliente->nome = $nome;
        $cliente->cpf = $cpf;
        $cliente->cep = $cep;
        $cliente->logradouro = $logradouro;
        $cliente->numero = $numero;
        $cliente->complemento = $complemento;
        $cliente->bairro = $bairro;
        $cliente->cidade = $cidade;
        $cliente->uf = $uf;
        $cliente->celular = $celular;
        $cliente->email = $email;
        $cliente->last_user = $user->name;
        $cliente->update();

        return view('clientes.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        return view('clientes.index');
    }

    //APIS INTERNAS

    public function consultaCep(Request $request)
    {
        // CONSUMO DE API USANDO O GET_FILE_CONTENTS
        // $cep = $request->input('cep');
        // $url = "https://viacep.com.br/ws/{$cep}/json/";

        // $response = file_get_contents($url);

        // return response()->json(json_decode($response));


        // CONSUMO DE API USANDO O CURL
        // $cep = $request->input('cep');
        // $url = "https://viacep.com.br/ws/{$cep}/json/";
    
        // // Inicializa o cURL
        // $ch = curl_init();
    
        // // Configurações do cURL
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout de 10 segundos
    
        // // Executa a requisição
        // $response = curl_exec($ch);
    
        // // Verifica se houve erro
        // if (curl_errno($ch)) {
        //     return response()->json(['error' => 'Erro ao consultar o CEP.'], 500);
        // }
    
        // // Fecha o cURL
        // curl_close($ch);

        // // Retorna a resposta decodificada
        // return response()->json(json_decode($response));

        // CONSUMO DE API USANDO O GuzzleHttp

        $cep = $request->input('cep');
        $url = "https://viacep.com.br/ws/{$cep}/json/";
    
        // Inicializa o cliente Guzzle
        $client = new Client();
    
        try {
            // Faz a requisição GET
            $response = $client->request('GET', $url);
    
            // Verifica o status da resposta
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true); // Decodifica o JSON
                return response()->json($data);
            }
    
            return response()->json(['error' => 'Erro ao consultar o CEP.'], $response->getStatusCode());
        } catch (\Exception $e) {
            // Trata erros de requisição
            return response()->json(['error' => 'Erro ao consultar o CEP: ' . $e->getMessage()], 500);
        }

    }


}
