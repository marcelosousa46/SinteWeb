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
      <div class="mensagem hidden alert-danger">
        <ul>
            <li id="mensagem">error</li>
        </ul>
      </div>
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
                            {!! Form::text('natop', isset($nota->cod_nat) ? $nota->natop:null, ['id'=>'natop','class'=>'form-control','placeholder'=>'descrição para pesquisa...']) !!}
                         </div>    
                      </div>    

                      <div class="row">
                          <div class="form-group col-md-2">
                            {!! Form::label('l.ind_pagto', 'Série') !!}
                            {!! Form::select('serie_id', $series,isset($nota->serie_id) ? $nota->serie_id:'1', ['class'=>'form-control']) !!}
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
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="pull-right">
                                  <button class="btn btn-default next-tab" type="button"><span class="glyphicon glyphicon-chevron-right"></span> Próximo</button>
                              </div>
                          </div>
                      </div>
                  </div>    
                  <div class="tab-pane fade" id="tab2primary">
                      <div class="row">
                          <div class="form-group col-md-4">
                            {!! Form::text('id_item',0, ['id'=>'id_item','class'=>'form-control hidden']) !!}
                            {!! Form::label('l.cod_item', 'Código produto') !!}
                            {!! Form::text('cod_item', isset($notaitem->cod_item) ? $notaitem->coditem:null, ['id'=>'cod_item','autocomplete'=>'off','class'=>'form-control','placeholder'=>'código para pesquisa...']) !!}
                          </div>    
                          <div class="form-group col-md-8 ui-widget">
                            {!! Form::label('l.descricao', 'Descrição produto') !!}
                            {!! Form::text('descricao', isset($notaitem->descricao) ? $notaitem->descricao:null, ['id'=>'descricao','class'=>'form-control','placeholder'=>'descrição para pesquisa...']) !!}
                         </div>    
                      </div>    
                      <div class="row">
                          <div class="form-group col-md-4 ui-widget">
                            {!! Form::label('l.CFOP', 'Natop') !!}
                            {!! Form::text('cfop', isset($notaitem->cfop) ? $notaitem->cfop:null, ['id'=>'cfop','autocomplete'=>'off','class'=>'form-control','placeholder'=>'código para pesquisa...']) !!}
                         </div>    
                         <div class="form-group col-md-8 ui-widget">
                            {!! Form::text('id_natop',0, ['id'=>'id_natop','class'=>'form-control hidden']) !!}
                            {!! Form::label('l.natop_descricao', 'Descrição natureza') !!}
                            {!! Form::text('descricao', null, ['id'=>'natop_descricao','class'=>'form-control','placeholder'=>'descrição para pesquisa...']) !!}
                         </div>    
                      </div>
                      <div class="row">
                         <div class="form-group col-md-2">
                            {!! Form::label('l.unid', 'Unidade') !!}
                            {!! Form::select('unid', $unidades,isset($notaitem->unid) ? $notaitem->unid:'1', ['class'=>'form-control']) !!}
                         </div>    
                          <div class="form-group col-md-2">
                            {!! Form::label('l.qtd', 'Qtde produto') !!}
                            {!! Form::text('qtd', isset($notaitem->qtd) ? $notaitem->qtd:null, ['id'=>'qtd','class'=>'form-control text-right']) !!}
                          </div>    
                          <div class="form-group col-md-2">
                            {!! Form::label('l.vl_item', 'Valor produto') !!}
                            {!! Form::text('vl_item', isset($notaitem->vl_item) ? $notaitem->vl_item:null, ['id'=>'vl_item','class'=>'form-control text-right']) !!}
                          </div>    
                          <div class="form-group col-md-2">
                            {!! Form::label('l.vl_desc', 'Valor desconto') !!}
                            {!! Form::text('vl_desc', isset($notaitem->vl_desc) ? $notaitem->vl_desc:null, ['id'=>'vl_desc','class'=>'form-control text-right']) !!}
                          </div>    
                          <div class="form-group col-md-2">
                            {!! Form::label('l.aliq_icms', 'Aliquota icms') !!}
                            {!! Form::text('aliq_icms', isset($notaitem->aliq_icms) ? $notaitem->aliq_icms:null, ['id'=>'aliq_icms','class'=>'form-control text-right']) !!}
                          </div>    
                          <div class="form-group col-md-2">
                            {!! Form::label('l.nbsp', '&nbsp;') !!}
                            <button id="btnAdicionar" class="btn btn-default btn-block" type="button"><span class="glyphicon glyphicon-plus"></span> Incluir item </button>
                          </div>    
                      </div>    
                      <table id="tblCadastro" class="table table-striped table-bordered">         
                        <thead>
                          <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th class='text-right'>Qtde</th>
                            <th class='text-right'>Valor do item</th>
                            <th>Opções</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
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
                      <div class="row">
                          <fieldset disabled>
                            <div class="form-group col-md-2">
                              {!! Form::label('l.qtd_item', 'Qtde itens') !!}
                              {!! Form::text('qtd_item', '0,00', ['id'=>'qtd_item','class'=>'form-control text-center']) !!}
                            </div>    
                            <div class="form-group col-md-2 ui-widget">
                              {!! Form::label('l.vl_merc', 'Valor mercadoria') !!}
                              {!! Form::text('vl_merc', '0,00', ['id'=>'vl_merc','class'=>'form-control text-right']) !!}
                           </div>    
                            <div class="form-group col-md-2 ui-widget">
                              {!! Form::label('l.vl_bc_icms', 'Valor base icms') !!}
                              {!! Form::text('vl_bc_icms', '0,00', ['id'=>'vl_bc_icms','class'=>'form-control text-right']) !!}
                           </div>    
                            <div class="form-group col-md-2 ui-widget">
                              {!! Form::label('l.vl_icms', 'Valor icms') !!}
                              {!! Form::text('vl_icms', '0,00', ['id'=>'vl_icms','class'=>'form-control text-right']) !!}
                           </div>    
                         </fieldset>
                      </div>    
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
    // Mascaras
    $("#qtd").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $("#vl_item").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $("#aliq_icms").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $("#vl_desc").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $("#vl_merc").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $("#qtd_item").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $("#vl_bc_icms").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $("#vl_icms").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
  </script>
@endpush

