@extends('layouts.lte')
@section('title', 'Usuários')
@section('ref')
  <li><class="active">Usuários</li>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <table class="table table-striped table-bordered table-hover" id="usuarios-table">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>Ação</th>
            </tr>
          </thead>
      </table>
    </div>
  </div>
</div>

@stop

@push('scripts')
  <script>
    $(function() {
        $('#usuarios-table').DataTable({
            language : {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
           "bLengthChange": false,
            processing: true,
            serverSide: false,
            ajax: '{!! URL::to('/usuarios/data') !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

    });
  </script>
@endpush
