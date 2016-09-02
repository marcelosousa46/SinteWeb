@extends('layouts.lte')
@section('title', 'Notas Fiscais')
@section('inclusao')
  <li class="item-inclusao"><a href="{{url('nota/create?id='.$rotina_id.',&user_id='.$user_id)}}"><i class="glyphicon glyphicon-plus"></i>Incluir</a></li>
@endsection
@section('ref')
  <li><class="active">Notas Fiscais</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      @if (count($errors) > 0)
      <div class="alert alert-danger fade in">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif          

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
      <table class="table table-striped table-bordered table-hover" id="participante-table">
          <thead>
            <tr>
              <th>Número</th>
              <th>Destinatário</th>
              <th>Data Emissão</th>
              <th>Valor</th>
              <th>Situação</th>
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
    $(".alert").fadeTo(5000, 0.4).slideUp(700, function(){
      $(".alert").alert('close');
    });

    $(function() {
        $('#participante-table').DataTable({
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
            ajax: '{!! URL::to('/nota/data') !!}',
            columns: [
                { data: 'cod_part', name: 'codigo' },
                { data: 'destinatario', name: 'nome' },
                { data: 'dt_doc'      , name: 'emissao' },
                { data: 'vl_doc'      , name: 'valor' },
                { data: 'situacao'    , name: 'situacao' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

    });
  </script>
@endpush
