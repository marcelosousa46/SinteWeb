@extends('layouts.lte')
@section('ref')
  <li><a href="{{url('nota?id='.$rotina_id.',&user_id='.$user_id)}}">Emissão de Notas</a></li>
@endsection
@if(isset($nota->id) )
  @section('ref1')
    <li class="active">Alteração</li>
  @endsection
@else
  @section('ref1')
    <li class="active">Inclusão</li>
  @endsection
@endif

@section('content')
<div class="container-fluid">
  <div class="col-md-12">
      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif          
      @if(isset($participante->id) )
          {!! Form::open(['route'=>['participante.update', $participante->id]]) !!}
      @else
          {!! Form::open(['route'=>'participante.store']) !!}
      @endif
      {!! csrf_field() !!}
      <div class="panel with-nav-tabs panel-primary">
          <div class="panel-heading clearfix">
              <div class="pull-left">
                  <h1 class="panel-title">Emissão de Notas</h1>
              </div>
              <div class="pull-right">
                  <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab1primary" data-toggle="tab">Cabeçalho</a></li>
                      <li><a href="#tab2primary" data-toggle="tab">Itens da nota</a></li>
                      <li><a href="#tab3primary" data-toggle="tab">Totalização</a></li>
                      <li><a href="#tab4primary" data-toggle="tab">Desdobramento</a></li>
                      <li><a href="#tab5primary" data-toggle="tab">Emissão</a></li>
                  </ul>
              </div>
          </div>
          <div class="panel-body">
              <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab1primary">
                      <div class="row">
                          <div class="form-group col-md-4">
                            {!! Form::label('l.dt_doc', 'Data emissão') !!}
                            {!! Form::date('dt_doc', isset($nota->dt_doc) ? $nota->dt_doc:\Carbon\Carbon::now(),  ['class'=>'form-control']) !!}
                          </div>    
                          <div class="form-group col-md-8 ui-widget">
                            {!! Form::label('l.natop', 'Natureza da operação') !!}
                            <div class="input-group">
                              {!! Form::text('cod_nat', isset($nota->cod_nat) ? $nota->nome:null, ['class'=>'form-control tags']) !!}
                              <div class="input-group-btn">
                                <button type="button" class="btn btn-default form-control" data-toggle="modal" data-target=".bs-example-modal-lg">
                                  <span class="glyphicon glyphicon-search"></span>
                                </button>  
                              </div>                            
                            </div>    
                         </div>    
                      </div>    
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="pull-right">
                                  <button class="btn btn-default next-tab" type="button"><span class="glyphicon glyphicon-chevron-right"></span> Próximo</button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="tab2primary">
                      <p>Primary 2</p>
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="pull-right">
                                  <button class="btn btn-default previous-tab" type="button"><span class="glyphicon glyphicon-chevron-left"></span> Anterior</button>
                                  <button class="btn btn-default next-tab" type="button"><span class="glyphicon glyphicon-chevron-right"></span> Próximo</button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="tab3primary">
                      <p>Primary 3</p>
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="pull-right">
                                  <button class="btn btn-default previous-tab" type="button"><span class="glyphicon glyphicon-chevron-left"></span> Anterior</button>
                                  <button class="btn btn-default next-tab" type="button"><span class="glyphicon glyphicon-chevron-right"></span> Próximo</button>
                              </div>
                          </div>
                      </div>
                      
                  </div>
                  <div class="tab-pane fade" id="tab4primary">
                      <p>Primary 4</p>
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="pull-right">
                                  <button class="btn btn-default previous-tab" type="button"><span class="glyphicon glyphicon-chevron-left"></span> Próximo</button>
                                  <button class="btn btn-default next-tab" type="button"><span class="glyphicon glyphicon-chevron-right"></span> Próximo</button>
                              </div>
                          </div>
                      </div>
                      
                  </div>
                  <div class="tab-pane fade" id="tab5primary">
                      <p>Primary 5</p>
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="pull-right">
                                  <button class="btn btn-default previous-tab" type="button"><span class="glyphicon glyphicon-chevron-left"></span> Anterior</button>
                                  <button class="btn btn-default next-tab" type="submit"><span class="glyphicon glyphicon-chevron-ok"></span> Enviar</button>
                              </div>
                          </div>
                      </div>
                      
                  </div>
              </div>
          </div>
      </div>
      {!! Form::close() !!}
  </div>
</div>
<!-- Modal para pesquisa -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Pesquisa das naturezas</h4>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-bordered table-hover" id="natop-table">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Descrição</th>
                  <th>Ação</th>
                </tr>
              </thead>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>      
    </div>
  </div>
</div>                

@endsection
@push('scripts')
  <script>
    $(".alert").fadeTo(5000, 0.4).slideUp(700, function(){
      $(".alert").alert('close');
    });

    $(function(){
        $('.nav-tabs a:first',this.$page).tab('show')
        $('.nav-tabs li:gt(0)',this.$page).each(function(){
            $(this).addClass('disabled');
            $('a',$(this)).attr('data-toggle','');
        });
        
        $('.next-tab').on('click',function(){
            var $panel = $(this).closest('.panel');
            var $tabs = $('.nav-tabs li',$panel);
            var $tab = $('.nav-tabs li.active',$panel);
            var index  = $tabs.index($tab);
            if (index < 0) {
                return; //no hope for you!
            }
            index++;
            var $next_tab = $('a',$tabs.eq(index));
            if (!$next_tab.length) {
                return;
            }
            $next_tab.parents('li').removeClass('disabled');
            $next_tab.attr('data-toggle','tab');
            $next_tab.tab('show');
        });
        $('.previous-tab').on('click',function(){
            var $panel = $(this).closest('.panel');
            var $tabs = $('.nav-tabs li',$panel);
            var $tab = $('.nav-tabs li.active',$panel);
            var index  = $tabs.index($tab);
            if (index < 0) {
                return; //no hope for you!
            }
            index--;
            var $previous_tab = $('a',$tabs.eq(index));
            if (!$previous_tab.length) {
                return;
            }
            $previous_tab.parents('li').removeClass('disabled');
            $previous_tab.data('toggle','tab');
            $previous_tab.tab('show');    });
        
    });    

    $(function() {
        $('#natop-table').DataTable({
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
            ajax: '{!! URL::to('/natop/data') !!}',
            columns: [
                { data: 'codigo', name: 'codigo' },
                { data: 'descricao', name: 'descricao' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

    });

  </script>
@endpush

