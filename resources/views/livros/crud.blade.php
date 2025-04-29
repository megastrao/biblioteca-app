@extends('adminlte::page')

@section('title', 'Cadastro de Livros')

@section('content_header')

@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Livros</h3>
        </div>
        <div class="card-body">
            <div class="form-group">

               

                @if (isset($edit->id))
                    <form method="post" action="{{ route('livro.update', ['livro' => $edit->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('livro.store') }}">
                            @csrf
                @endif


                <div class="row">
                    <div class="col-sm-2">
                        <label for="isbn">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder=""
                            value="{{ $edit->isbn ?? old('isbn') }}">
                        @if ($errors->has('isbn'))
                            <span style="color: red;">
                                {{ $errors->first('isbn') }}
                            </span>
                        @endif
                        <br>
                    </div>

                    <div class="col-sm-6">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder=""
                            value="{{ $edit->titulo ?? old('titulo') }}">
                        @if ($errors->has('titulo'))
                            <span style="color: red;">
                                {{ $errors->first('titulo') }}
                            </span>
                        @endif
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="autor">Autor</label>
                        <select class="form-control" id="autor_id" name="autor_id">
                            <option value="">Selecione</option>
                            @foreach ($autores as $autor)
                                <option value="{{ $autor->id }}" {{ @$edit->autor_id == $autor->id ? 'selected' : '' }}>
                                    {{ $autor->autor }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('autor'))
                            <span style="color: red;">
                                {{ $errors->first('autor') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-4">
                        <label for="editora">Editora</label>
                        <select class="form-control" id="editora_id" name="editora_id">
                            <option value="">Selecione</option>
                            @foreach ($editoras as $editora)
                                
                                <option value="{{ $editora->id }}"
                                    {{ @$edit->editora_id == $editora->id ? 'selected' : '' }}>
                                    {{ $editora->editora }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('editora'))
                            <span style="color: red;">
                                {{ $errors->first('editora') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-4">
                        <label for="genero">Genero</label>
                        <select class="form-control" id="genero_id" name="genero_id">
                            <option value="">Selecione</option>
                            @foreach ($generos as $genero)
                                <option value="{{ $genero->id }}"
                                    {{ @$edit->genero_id == $genero->id ? 'selected' : '' }}>
                                    {{ $genero->genero }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('genero'))
                            <span style="color: red;">
                                {{ $errors->first('genero') }}
                            </span>
                        @endif
                        <br>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="classificacao">Classificacao</label>
                        <input type="number" class="form-control" id="classificacao" name="classificacao" placeholder=""
                            value="{{ $edit->classificacao ?? old('classificacao') }}">
                        @if ($errors->has('classificacao'))
                            <span style="color: red;">
                                {{ $errors->first('classificacao') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-4">
                        <label for="edicao">Edicao</label>
                        <input type="text" class="form-control" id="edicao" name="edicao" placeholder=""
                            value="{{ $edit->edicao ?? old('edicao') }}">
                        @if ($errors->has('edicao'))
                            <span style="color: red;">
                                {{ $errors->first('edicao') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-4">
                        <label for="saldo">Saldo</label>
                        <input type="number" class="form-control" id="saldo" name="saldo" placeholder=""
                            value="{{ $edit->saldo ?? old('saldo') }}">
                        @if ($errors->has('saldo'))
                            <span style="color: red;">
                                {{ $errors->first('saldo') }}
                            </span>
                        @endif
                        <br>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('livro.index') }}" type="button" class="btn btn-secondary">Voltar</a>
                </div>
                </form>

            </div>
        @stop

        @section('css')
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        @stop

        @section('js')
            <script src="{{ asset('vendor/jquery/jquery.maskedinput.min.js') }}"></script>
            <script src="{{ asset('vendor/jquery/jquery.maskMoney.min.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

            <script>
                $(document).ready(function() {



                });
            </script>
        @stop
