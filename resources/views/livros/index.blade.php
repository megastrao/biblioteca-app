@extends('adminlte::page')

@section('title', 'Cadastro de Livros')

@section('content_header')
<h1>Livros</h1>
@stop

@section('plugins.Datatables', true)

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Livros</h3>
    </div>

    <div class="card-body">
        <div>
            <a href="{{ route('livro.create') }}" type="button" class="btn btn-primary" style="width:80px;">Novo</a>
        </div>
        <br>
        <table class="table table-bordered table-striped dataTable dtr-inline" id="livro-table" style="font-size: 15px;">
            <thead>
                <tr>
                    <th style="width: 5%">Id</th>
                    <th style="width: 10%">ISBN</th>
                    <th style="width: 40%">Titulo</th>
                    <th style="width: 10%">Autor</th>
                    <th style="width: 10%">Editora</th>
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
    $(document).ready(function () {

        $('#livro-table').DataTable({
            language: {
                "url": "{{ asset('js/pt-br.json') }}"
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('livro.index') }}",
            columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'isbn',
                name: 'isbn'
            },
            {
                data: 'titulo',
                name: 'titulo'
            },
            {
                data: 'autor',
                name: 'autor'
            },
            {
                data: 'editora',
                name: 'editora'
            },
            
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@stop