@extends('layouts.lte')
@section('title', 'Permissões')
@section('inclusao')
  <li class="item-inclusao"><a href="{{url('permissoes/create?id='.$rotina_id.',&user_id='.$user_id)}}"><i class="glyphicon glyphicon-plus"></i>Incluir</a></li>
  <li class="item-inclusao"><a href="{{url('permissoes/gerar?id='.$rotina_id.',&user_id='.$user_id)}}"><i class="fa fa-magic margem-menu-pagina-10"></i>Permitir todas</a></li>
@endsection
@section('ref')
  <li><class="active">Permissões</li>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      @if (session('status'))
        @if (session('status') == 'error')
          <div class="alert alert-danger fade in">
            <h4>Atenção!</h4>
            {{ session('status-mensagem') }}
            {{ session()->forget('status') }}
          </div>
        @endif  
        @if (session('status') == 'sucesso')
          <div class="alert alert-success fade in">
            <h4>Atenção!</h4>
            {{ session('status-mensagem') }}
            {{ session()->forget('status') }}
          </div>
        @endif  
      @endif
  </div>
  <div class="row">
    <div class="col-md-10">
      <table class="table table-striped table-bordered table-hover" id="permissoes-table">
          <thead>
            <tr>
              <th>Rotina</th>
              <th>Usuário</th>
              <th>Liberado</th>
              <th>Incluir</th>
              <th>Alterar</th>
              <th>Consultar</th>
              <th>Excluir</th>
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
        $('#permissoes-table').DataTable({
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
            ajax: '{!! URL::to('/permissoes/data') !!}',
            columns: [
                { data: 'descricao', name: 'descricao' },
                { data: 'name', name: 'usuario' },
                { data: 'liberado', name: 'liberado' },
                { data: 'incluir', name: 'incluir' },
                { data: 'alterar', name: 'alterar' },
                { data: 'consultar', name: 'consultar' },
                { data: 'excluir', name: 'exncluir' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

    });
  </script>
@endpush
