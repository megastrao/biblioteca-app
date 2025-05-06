@extends('adminlte::page')

@section('title', 'Cadastro de Clientes')

@section('content_header')

@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Clientes</h3>
        </div>
        <div class="card-body"s>
            <div class="form-group">

                @if (isset($edit->id))
                    <form method="post" action="{{ route('cliente.update', ['cliente' => $edit->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('cliente.store') }}">
                            @csrf
                @endif

                <div class="row">
                    <div class="col-sm-10">
                        <label for="nome">Cliente</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder=""
                            value="{{ $edit->nome ?? old('nome') }}">
                        @if ($errors->has('nome'))
                            <span style="color: red;">
                                {{ $errors->first('nome') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-2">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder=""
                            value="{{ $edit->cpf ?? old('cpf') }}">
                        @if ($errors->has('cpf'))
                            <span style="color: red;">
                                {{ $errors->first('cpf') }}
                            </span>
                        @endif
                        <br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" placeholder=""
                            value="{{ $edit->cep ?? old('cep') }}">
                        @if ($errors->has('cep'))
                            <span style="color: red;">
                                {{ $errors->first('cep') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-4">
                        <label for="logradouro">Logradouro</label>
                        <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder=""
                            value="{{ $edit->logradouro ?? old('logradouro') }}">
                        @if ($errors->has('logradouro'))
                            <span style="color: red;">
                                {{ $errors->first('logradouro') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-4">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero" placeholder=""
                            value="{{ $edit->numero ?? old('numero') }}">
                        @if ($errors->has('numero'))
                            <span style="color: red;">
                                {{ $errors->first('numero') }}
                            </span>
                        @endif
                        <br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="form-control" id="complemento" name="complemento" placeholder=""
                            value="{{ $edit->complemento ?? old('complemento') }}">
                        @if ($errors->has('complemento'))
                            <span style="color: red;">
                                {{ $errors->first('complemento') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-4">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" placeholder=""
                            value="{{ $edit->bairro ?? old('bairro') }}">
                        @if ($errors->has('bairro'))
                            <span style="color: red;">
                                {{ $errors->first('bairro') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-4">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" placeholder=""
                            value="{{ $edit->cidade ?? old('cidade') }}">
                        @if ($errors->has('cidade'))
                            <span style="color: red;">
                                {{ $errors->first('cidade') }}
                            </span>
                        @endif
                        <br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <label for="uf">UF</label>
                        <input type="text" class="form-control" id="uf" name="uf" placeholder=""
                            value="{{ $edit->uf ?? old('uf') }}">
                        @if ($errors->has('uf'))
                            <span style="color: red;">
                                {{ $errors->first('uf') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-4">
                        <label for="celular">Celular</label>
                        <input type="text" class="form-control" id="celular" name="celular" placeholder=""
                            value="{{ $edit->celular ?? old('celular') }}">
                        @if ($errors->has('celular'))
                            <span style="color: red;">
                                {{ $errors->first('celular') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-4">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder=""
                            value="{{ $edit->email ?? old('email') }}">
                        @if ($errors->has('email'))
                            <span style="color: red;">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                        <br>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="{{ route('cliente.index') }}" type="button" class="btn btn-secondary">Voltar</a>
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
