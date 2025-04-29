@extends('adminlte::page')

@section('title', 'Cadastro de Generos')

@section('content_header')
    <h1>Generos</h1>
@stop

@section('plugins.Datatables', true)

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Generos</h3>
        </div>

        <div class="card-body">
            <div>
                <a href="{{ route('genero.create') }}" type="button" class="btn btn-primary" style="width:80px;">Novo</a>
            </div>
            <br>
            <table class="table table-bordered table-striped dataTable dtr-inline" id="genero-table" style="font-size: 15px;">
                <thead>
                    <tr>
                        <th style="width: 5%">Id</th>
                        <th style="width: 50%">genero</th>
                        <th style="width: 10%">Ações</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
@stop

@section('js')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#genero-table').DataTable({
                language: {
                    "url": "{{ asset('js/pt-br.json') }}"
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('genero.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'genero',
                        name: 'genero'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@stop
