@extends('adminlte::page')

@section('title', 'Cadastro de Editoras')

@section('content_header')

@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Editoras</h3>
        </div>
        <div class="card-body"s>
            <div class=" form-group">

                @if (isset($edit->id))
                    <form method="post" action="{{ route('editora.update', ['editora' => $edit->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('editora.store') }}">
                            @csrf
                @endif

                <label for="editora">Editora</label>
                <input type="text" class="form-control" id="editora" name="editora" placeholder=""
                    value="{{ $edit->editora ?? old('editora') }}">
                @if ($errors->has('editora'))
                    <span style="color: red;">
                        {{ $errors->first('editora') }}
                    </span>
                @endif
                <br>

                <label>Nacionalidde</label>
                <select class="form-control" name="nacional" id="nacional">
                    <option value="0" {{ @$edit->nacional == 0 ? 'selected' : '' }}>Estrangeira
                    </option>
                    <option value="1" {{ @$edit->nacional == 1 ? 'selected' : '' }}>Nacional
                    </option>
                </select>
                @if ($errors->has('nacional'))
                    <span style="color: red;">
                        {{ $errors->first('nacional') }}
                    </span>
                @endif
                <br>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="{{ route('editora.index') }}" type="button" class="btn btn-secondary">Voltar</a>
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
        f

        $(document).ready(function() {

            

        });
    </script>
@stop