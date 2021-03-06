@extends('layouts.lte')
@section('title', 'Rotinas')
@section('inclusao')
  <li class="item-inclusao"><a href="{{url('rotinas/create?id='.$rotina_id.',&user_id='.$user_id)}}"><i class="glyphicon glyphicon-plus"></i>Incluir</a></li>
@endsection
@section('ref')
  <li><class="active">Rotinas</li>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      @if (session('status'))
        <div class="alert alert-danger fade in">
          <h4>Atenção!</h4>
          {{ session('status') }}
        </div>
      @endif
  </div>
  <div class="row">
    <div class="col-md-10">
      <table class="table table-striped table-bordered table-hover" id="rotinas-table">
          <thead>
            <tr>
              <th>Descrição</th>
              <th>Tipo</th>
              <th>Pai</th>
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
    $(".alert").fadeTo(2000, 0.4).slideUp(700, function(){
      $(".alert").alert('close');
    });

    $(function() {
        $('#rotinas-table').DataTable({
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
            ajax: '{!! URL::to('/rotinas/data') !!}',
            columns: [
                { data: 'descricao', name: 'descricao' },
                { data: 'tipo', name: 'tipo' },
                { data: 'nivel', name: 'nivel' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

    });
  </script>
@endpush
