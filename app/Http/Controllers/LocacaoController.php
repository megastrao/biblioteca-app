<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Livro;
use App\Models\Cliente;
use App\Models\Locacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LocacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $data = Locacao::with(['livro', 'cliente'])
                ->where('data_devolucao', '=', null)
                ->where('deletado', '=', 0)
                ->get(); // Certifique-se de carregar as relações

            return DataTables::of($data)
                ->addColumn('titulo', function ($row) {
                    return $row->livro->titulo ?? 'N/A'; // Ajuste o campo conforme o nome no modelo
                })
                ->addColumn('nome', function ($row) {
                    return $row->cliente->nome ?? 'N/A'; // Ajuste o campo conforme o nome no modelo
                })
                ->addColumn('action', function ($row) {
                    $actionBtns = '
                    <a href="' . route("locacao.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                    
                    <form action="' . route("locacao.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
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

        return view('locacoes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();

        $livros = Livro::all();

        $alugados = Locacao::select('livro_id', DB::raw('COUNT(livro_id) as total'))
            ->where('deletado', 0)
            ->whereNull('data_devolucao')
            ->groupBy('livro_id')
            ->get();

        $saldo_livros = array();

        foreach ($livros as $livro) {
            $saldo = $livro->saldo;

            foreach ($alugados as $alugado) {
                if ($livro->id == $alugado->livro_id) {
                    $saldo -= $alugado->total;
                }
            }

            $saldo_livros[] = [
                'id' => $livro->id,
                'titulo' => $livro->titulo,
                'saldo' => $saldo
            ];
        }

        // dd($saldo_livros);

        $output = array(
            'clientes' => $clientes,
            'livros' => $saldo_livros
        );

        return view('locacoes.crud', $output);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $user = Auth::user();

        $livro_id = $request->livro_id;
        $cliente_id = $request->cliente_id;
        $data_locacao = date('Y-m-d h:m:s');
        $dias_locacao = $request->dias_locacao;
        $data_prevista_devolucao = Carbon::createFromFormat('d/m/Y', $request->data_prevista_devolucao)->format('Y-m-d');
        $origin_user = $user->name;
        $last_user = $user->name;

        $loc = new Locacao();
        $loc->livro_id = $livro_id;
        $loc->cliente_id = $cliente_id;
        $loc->data_locacao = $data_locacao;
        $loc->dias_locacao = $dias_locacao;
        $loc->data_prevista_devolucao = $data_prevista_devolucao;
        $loc->origin_user = $origin_user;
        $loc->last_user = $last_user;
        $loc->save();

        return view('locacoes.index');
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
        $edit = Locacao::find($id);

        $clientes = Cliente::all();

        $livros = Livro::all();

        $alugados = Locacao::select('livro_id', DB::raw('COUNT(livro_id) as total'))
            ->where('deletado', 0)
            ->whereNull('data_devolucao')
            ->groupBy('livro_id')
            ->get();

        $saldo_livros = array();

        foreach ($livros as $livro) {
            $saldo = $livro->saldo;

            foreach ($alugados as $alugado) {
                if ($livro->id == $alugado->livro_id) {
                    $saldo -= $alugado->total;
                }
            }

            $saldo_livros[] = [
                'id' => $livro->id,
                'titulo' => $livro->titulo,
                'saldo' => $saldo
            ];
        }


        $output = array(
            'clientes' => $clientes,
            'livros' => $saldo_livros,
            'edit' => $edit
        );

        return view('locacoes.crud', $output);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $user = Auth::user();
        $data_devolucao = $request->data_devolucao;

        $loc = Locacao::find($id);
        $loc->data_devolucao = $data_devolucao;
        $loc->last_user = $user->name;
        $loc->update();

        return view('locacoes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $loc = Locacao::find($id);

        $loc->deletado = 1;
        $loc->update();

        return view('locacoes.index');
    }
}
