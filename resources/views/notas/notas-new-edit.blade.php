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
          {!! Form::open(['route'=>['nota.update', $participante->id]]) !!}
      @else
          {!! Form::open(['route'=>'nota.store']) !!}
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
                            {!! Form::label('l.natop', 'Natureza operação') !!}
                            <div class="input-group">
                              {!! Form::text('cod_nat', isset($nota->cod_nat) ? $nota->nome:null, ['class'=>'form-control tags']) !!}
                              <div class="input-group-btn">
                                <button type="button" class="pesquisa btn btn-default form-control">
                                  <span class="glyphicon glyphicon-search"></span>
                                </button>  
                              </div>                            
                            </div>    
                            <input class="typeahead hidden form-control" type="text" placeholder="digite sua pesquisa...">

                         </div>    
                      </div>    

                      <div class="row">
                          <div class="form-group col-md-2">
                            {!! Form::label('l.ind_pagto', 'Série') !!}
                            {!! Form::select('serie_id', $serie_id,isset($nota->serie_id) ? $nota->serie_id:'1', ['class'=>'form-control']) !!}
                          </div>    
                          <div class="form-group col-md-2">
                            {!! Form::label('l.ind_pagto', 'Pagamento') !!}
                            {!! Form::select('ind_pagto', array('0' => 'à vista', '1' => 'à prazo', '2' => 'Outros'),isset($nota->ind_pagto) ? $nota->ind_pagto:'0', ['class'=>'form-control']) !!}
                          </div>    
                          <div class="form-group col-md-4">
                            {!! Form::label('l.tpNf', 'Tipo de operação') !!}
                            {!! Form::select('tpNf', array('0' => 'Entrada', '1' => 'Saída'),isset($nota->tpNf) ? $nota->tpNf:'1', ['class'=>'form-control']) !!}
                          </div>    
                          <div class="form-group col-md-4">
                            {!! Form::label('l.idDest', 'Destino da operação') !!}
                            {!! Form::select('idDest', array('1' => 'Interna', '2' => 'Interestadual', '3' => 'Exterior'),isset($nota->idDest) ? $nota->idDest:'1', ['class'=>'form-control']) !!}
                          </div>    
                      </div>    

                      <div class="row">
                          <div class="form-group col-md-4">
                            {!! Form::label('l.tpEmis', 'Tipo de Emissão') !!}
                            {!! Form::select('tpEmis', array('1' => 'Normal', '2' => 'Contingência FS-IA', '3' => 'Contingência SCAN', 
                                                             '4' => 'Contingência DPEC', '5' => 'Contingência FS-DA',
                                                             '6' => 'Contingência SVC-AN', '7' => 'Contingência SVC-RS'),isset($nota->tpEmis) ? $nota->tpEmis:'1', ['class'=>'form-control']) !!}
                          </div>    
                          <div class="form-group col-md-4">
                            {!! Form::label('l.finNFe', 'Finalidade') !!}
                            {!! Form::select('finNFe', array('1' => 'Normal', '2' => 'Complementar', '3' => 'Ajuste',
                                                             '4' => 'Devolução/Retorno'),isset($nota->finNFe) ? $nota->finNFe:'1', ['class'=>'form-control']) !!}
                          </div>    
                          <div class="form-group col-md-4">
                            {!! Form::label('l.indFinal', 'Consumidor final') !!}
                            {!! Form::select('indFinal', array('0' => 'Normal', '1' => 'Consumidor final'),isset($nota->indFinal) ? $nota->indFinal:'0', ['class'=>'form-control']) !!}
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

    var path = "{!! URL::to('/natop/autocomplete') !!}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        },
        updater: function (item) {
           $('input.typeahead').removeClass('visible');
           $('input.typeahead').addClass('hidden');
           $('.tags').val(item.name);
           $('.tags').focus();
           return item;
        }
    });
    $('input.typeahead').blur(function() {
       $('input.typeahead').removeClass('visible');
       $('input.typeahead').addClass('hidden');
    });
    $( ".pesquisa" ).click(function() {
       $('input.typeahead').val('');
       $('input.typeahead').removeClass('hidden');
       $('input.typeahead').addClass('visible');
       $('input.typeahead').focus();

    });
  </script>
@endpush

