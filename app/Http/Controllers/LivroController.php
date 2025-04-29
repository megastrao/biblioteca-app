<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Editora;
use App\Models\Genero;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (request()->ajax()) {

            $data = Livro::with(['autor', 'editora'])->get(); // Certifique-se de carregar as relações
            return DataTables::of($data)
                ->addColumn('autor', function ($row) {
                    return $row->autor->autor ?? 'N/A'; // Ajuste o campo conforme o nome no modelo
                })
                ->addColumn('editora', function ($row) {
                    return $row->editora->editora ?? 'N/A'; // Ajuste o campo conforme o nome no modelo
                })
                ->addColumn('action', function ($row) {
                    $actionBtns = '
                    <a href="' . route("livro.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                    
                    <form action="' . route("livro.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
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

        return view('livros.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $autores = Autor::all();
        $editoras = Editora::all();
        $generos = Genero::all();

        $output = array(
            'autores' => $autores,
            'editoras' => $editoras,
            'generos' => $generos
        );

        return view('livros.crud', $output);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $livro_data = $request->all();

        $livro = new Livro();
        $livro->isbn = $livro_data['isbn'];
        $livro->titulo = $livro_data['titulo'];
        $livro->autor_id = $livro_data['autor_id'];
        $livro->editora_id = $livro_data['editora_id'];
        $livro->genero_id = $livro_data['genero_id'];
        $livro->classificacao = $livro_data['classificacao'];
        $livro->edicao = $livro_data['edicao'];
        $livro->saldo = $livro_data['saldo'];
        $livro->origin_user = $user->name;
        $livro->last_user = $user->name;
        $livro->save();

        return view('livros.index');
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

        $livro = Livro::find($id);
        $autores = Autor::all();
        $editoras = Editora::all();
        $generos = Genero::all();

        $output = array(
            'autores' => $autores,
            'editoras' => $editoras,
            'generos' => $generos,
            'edit' => $livro
        );

        return view('livros.crud', $output);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $livro_data = $request->all();

        $livro = Livro::find($id);
        $livro->isbn = $livro_data['isbn'];
        $livro->titulo = $livro_data['titulo'];
        $livro->autor_id = $livro_data['autor_id'];
        $livro->editora_id = $livro_data['editora_id'];
        $livro->genero_id = $livro_data['genero_id'];
        $livro->classificacao = $livro_data['classificacao'];
        $livro->edicao = $livro_data['edicao'];
        $livro->saldo = $livro_data['saldo'];
        $livro->last_user = $user->name;
        $livro->update();

        return view('livros.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $livro = Livro::find($id);
        $livro->delete();

        return view('livros.index');
    }
}
