@extends('adminlte::page')

@section('title', 'Cadastro de Autores')

@section('content_header')

@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Autores</h3>
        </div>
        <div class="card-body"s>
            <div class="form-group">

                @if (isset($edit->id))
                    <form method="post" action="{{ route('autor.update', ['autor' => $edit->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('autor.store') }}">
                            @csrf
                @endif

                <label for="autor">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" placeholder=""
                    value="{{ $edit->autor ?? old('autor') }}">
                @if ($errors->has('autor'))
                    <span style="color: red;">
                        {{ $errors->first('autor') }}
                    </span>
                @endif
                <br>
                <label for="nacionalidade">Nacionalidade</label>
                <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" placeholder=""
                    value="{{ $edit->nacionalidade ?? old('nacionalidade') }}">
                @if ($errors->has('nacionalidade'))
                    <span style="color: red;">
                        {{ $errors->first('nacionalidade') }}
                    </span>
                @endif
                <br>

            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="{{ route('autor.index') }}" type="button" class="btn btn-secondary">Voltar</a>
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