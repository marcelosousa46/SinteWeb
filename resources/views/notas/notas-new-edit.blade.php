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
      @if(isset($nota->id) )
          {!! Form::open(['id'=>'nota','route'=>['nota.update', $nota->id]]) !!}
      @else
          {!! Form::open(['id'=>'nota','route'=>'nota.store']) !!}
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
                            <!-- ID da nota, campo não disponível na view -->
                            {!! Form::text('nota_id',isset($nota->id) ? $nota->id:0, ['id'=>'nata_id','class'=>'form-control hidden']) !!}
                            {!! Form::label('l.dt_doc', 'Data emissão') !!}
                            {!! Form::date('dt_doc', isset($nota->dt_doc) ? $nota->dt_doc:\Carbon\Carbon::now(),  ['class'=>'form-control']) !!}
                          </div>    
                          <div class="form-group col-md-8 ui-widget">
                            <!-- Natureza da venda, campo não disponível na view -->
                            {!! Form::text('natop_id',isset($nota->natop_id) ? $nota->natop_id:0, ['id'=>'natop_id','class'=>'form-control hidden']) !!}
                            {!! Form::label('l.natop', 'Natureza operação') !!}
                            {!! Form::text('natop', isset($nota->natop_id) ? $nota->natop->descricao:null, ['id'=>'natop','class'=>'form-control','placeholder'=>'descrição para pesquisa...']) !!}
                         </div>    
                      </div>    

                      <div class="row">
                          <div class="form-group col-md-2">
                            {!! Form::label('l.ind_pagto', 'Série') !!}
                            {!! Form::select('ser', $series,isset($nota->ser) ? $nota->ser:'1', ['id'=>'ser','class'=>'form-control']) !!}
                          </div>    
                          <div class="form-group col-md-2">
                            {!! Form::label('l.ind_pagto', 'Pagamento') !!}
                            {!! Form::select('ind_pagto', array('0' => 'à vista', '1' => 'à prazo', '2' => 'Outros'),isset($nota->ind_pagto) ? $nota->ind_pagto:'0', ['class'=>'form-control']) !!}
                          </div>    
                          <div class="form-group col-md-4">
                            {!! Form::label('l.tpNf', 'Tipo de operação') !!}
                            {!! Form::select('ind_oper', array('0' => 'Entrada', '1' => 'Saída'),isset($nota->ind_oper) ? $nota->ind_oper:'1', ['class'=>'form-control']) !!}
                          </div>    
                          <div class="form-group col-md-4">
                            {!! Form::label('l.idDest', 'Destino da operação') !!}
                            {!! Form::select('idDest', array('1' => 'Interna', '2' => 'Interestadual', '3' => 'Exterior'),isset($nota->idDest) ? $nota->idDest:'1', ['class'=>'form-control']) !!}
                          </div>    
                      </div>    

                      <div class="row">
                          <div class="form-group col-md-4">
                            {!! Form::label('l.tpEmis', 'Tipo de Emissão') !!}
                            {!! Form::select('tpemis', array('1' => 'Normal', '2' => 'Contingência FS-IA', '3' => 'Contingência SCAN', 
                                                             '4' => 'Contingência DPEC', '5' => 'Contingência FS-DA',
                                                             '6' => 'Contingência SVC-AN', '7' => 'Contingência SVC-RS'),isset($nota->tpemis) ? $nota->tpemis:'1', ['class'=>'form-control']) !!}
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
                          <!-- Emissão prórpia, campo não disponível na view -->
                          {!! Form::text('ind_emit',0, ['id'=>'ind_emit','class'=>'form-control hidden']) !!}
                          <!-- Documento regular, campo não disponível na view -->
                          {!! Form::text('cod_sit','00', ['id'=>'cod_sit','class'=>'form-control hidden']) !!}
                          <!-- Emissão prórpia, campo não disponível na view -->
                          {!! Form::text('cod_mod','55', ['id'=>'cod_mod','class'=>'form-control hidden']) !!}
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
                            <!-- Id do produto para validação, campo não disponível na view -->
                            {!! Form::text('produto_id',0, ['id'=>'produto_id','class'=>'form-control hidden']) !!}
                            <!-- Cst do produto para calculo de impostos, campo não disponível na view -->
                            {!! Form::text('cst',null, ['id'=>'cst','class'=>'form-control hidden']) !!}
                            <!-- taxa do icms do produto para calculo de impostos, campo não disponível na view -->
                            {!! Form::text('icms',null, ['id'=>'icms','class'=>'form-control hidden']) !!}
                            <!-- taxa do pis do produto para calculo de impostos, campo não disponível na view -->
                            {!! Form::text('pis',null, ['id'=>'pis','class'=>'form-control hidden']) !!}
                            <!-- taxa do cofins do produto para calculo de impostos, campo não disponível na view -->
                            {!! Form::text('cofins',null, ['id'=>'cofins','class'=>'form-control hidden']) !!}
                            <!-- *** -->
                            {!! Form::label('l.cod_item', 'Código produto') !!}
                            {!! Form::text('cod_item', isset($notaitem->cod_item) ? $notaitem->coditem:null, ['id'=>'cod_item','autocomplete'=>'off','class'=>'form-control','placeholder'=>'código para pesquisa...']) !!}
                          </div>    
                          <div class="form-group col-md-8 ui-widget">
                            {!! Form::label('l.descricao', 'Descrição produto') !!}
                            {!! Form::text('descricao[]', isset($notaitem->descricao) ? $notaitem->descricao:null, ['id'=>'descricao','class'=>'form-control','placeholder'=>'descrição para pesquisa...']) !!}
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
                            {!! Form::text('qtd', isset($notaitem->qtd) ? $notaitem->qtd:null, ['id'=>'qtd','class'=>'form-control text-right mascara-monetaria']) !!}
                          </div>    
                          <div class="form-group col-md-2">
                            {!! Form::label('l.vl_item', 'Vlr produto R$') !!}
                            {!! Form::text('vl_item', isset($notaitem->vl_item) ? $notaitem->vl_item:null, ['id'=>'vl_item','class'=>'form-control text-right mascara-monetaria']) !!}
                          </div>    
                          <div class="form-group col-md-2">
                            {!! Form::label('l.vl_desc', 'Vlr desconto R$') !!}
                            {!! Form::text('vl_desc', isset($notaitem->vl_desc) ? $notaitem->vl_desc:null, ['id'=>'vl_desc','class'=>'form-control text-right mascara-monetaria']) !!}
                          </div>    
                          <div class="form-group col-md-2">
                            {!! Form::label('l.aliq_icms', 'Aliq. icms (%)') !!}
                            {!! Form::text('aliq_icms', isset($notaitem->aliq_icms) ? $notaitem->aliq_icms:null, ['id'=>'aliq_icms','class'=>'form-control text-right mascara-monetaria']) !!}
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
                            <th class="text-right">Qtde</th>
                            <th class="text-right">Vlr item R$</th>
                            <th>Opções</th>
                          </tr>

                        </thead>
                        <tbody>
                        @if (isset($nota->id) )                          
                          @if ($nota->itens->count() > 0)
                              @for($i = 0; $i < $nota->itens->count(); $i++)
                                <tr>
                                  <td>{{ $nota->itens[$i]->produtos->codigo }}</td>
                                  <td>{{ $nota->itens[$i]->produtos->descricao }}</td>
                                  <td class='text-right'>{{ $nota->itens[$i]->qtd }}</td>
                                  <td class='text-right'>{{ $nota->itens[$i]->vl_item }}</td>
                                  <td><button id= {{ $i }} class='btnExcluir btn btn-default btn-xs' type='button'><span class='glyphicon glyphicon-remove'></span></button></td>
                                  <input type='text' name='nitem' class='hidden' id='nitem' value= {{ $i }} />
                                </tr>
                                <input type='text' name='item_id_item[]' class='hidden' id='id_item{{ $i }}' value= {{ $nota->itens[$i]->id }} />
                                <input type='text' name='item_produto_id[]' class='hidden' id='produto_id{{ $i }}' value= {{ $nota->itens[$i]->produtos_id }} />
                                <input type='text' name='item_vl_item[]' class='hidden' id='vl_item{{ $i }}' value= {{ $nota->itens[$i]->vl_item }} />
                                <input type='text' name='item_qtd[]' class='hidden' id='qtd{{ $i }}' value= {{ $nota->itens[$i]->qtd }} />
                                <input type='text' name='item_vl_icms[]' class='hidden' id='vl_icms{{ $i }}' value= {{ $nota->itens[$i]->vl_icms }} />
                                <input type='text' name='item_vl_pis[]' class='hidden' id='vl_pis{{ $i }}' value= {{ $nota->itens[$i]->vl_pis }} />
                                <input type='text' name='item_vl_cofins[]' class='hidden' id='vl_cofins{{ $i }}' value= {{ $nota->itens[$i]->vl_cofins }} />
                                <input type='text' name='item_cst[]' class='hidden' id='cst{{ $i }}' value= {{ $nota->itens[$i]->cst_icms }} />
                                <input type='text' name='item_icms[]' class='hidden' id='icms{{ $i }}' value= {{ $nota->itens[$i]->aliq_icms }} />
                                <input type='text' name='item_pis[]' class='hidden' id='pis{{ $i }}' value= {{ $nota->itens[$i]->aliq_pis }} />
                                <input type='text' name='item_cofins[]' class='hidden' id='cofins{{ $i }}' value= {{ $nota->itens[$i]->aliq_cofins }} />
                                <input type='text' name='item_natop_id[]' class='hidden' id='natop{{ $i }}' value= {{ $nota->itens[$i]->natop_id }} />
                                <input type='text' name='item_vl_bc_icms[]' class='hidden' id='vl_bc_icms{{ $i }}' value= {{ $nota->itens[$i]->vl_bc_icms }} />
                                <input type='text' name='item_vl_bc_pis[]' class='hidden' id='vl_bc_pis{{ $i }}' value= {{ $nota->itens[$i]->vl_bc_pis }} />
                                <input type='text' name='item_vl_bc_cofins[]' class='hidden' id='vl_bc_cofins{{ $i }}' value= {{ $nota->itens[$i]->vl_bc_cofins }} />
                              @endfor

                          @endif
                        @endif  
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
                          <div class="form-group col-md-2">
                            {!! Form::label('l.qtd_item', 'Qtde itens') !!}
                            {!! Form::text('qtd_item', isset($nota->id) ? $nota->itens->count()*100:'0,00', ['id'=>'qtd_item','class'=>'form-control text-center mascara-monetaria']) !!}
                          </div>    
                          <div class="form-group col-md-2 ui-widget">
                            {!! Form::label('l.vl_merc', 'Vlr mercadoria R$') !!}
                            {!! Form::text('vl_merc', isset($nota->vl_merc) ? $nota->vl_merc:'0,00', ['id'=>'vl_merc','class'=>'form-control text-right mascara-monetaria']) !!}
                         </div>    
                          <div class="form-group col-md-2 ui-widget">
                            {!! Form::label('l.vl_doc', 'Vlr documento R$') !!}
                            {!! Form::text('vl_doc', isset($nota->vl_doc) ? $nota->vl_doc:'0,00', ['id'=>'vl_doc','class'=>'form-control text-right mascara-monetaria']) !!}
                         </div>    
                          <div class="form-group col-md-2 ui-widget">
                            {!! Form::label('l.vl_bc_icms', 'Base icms R$') !!}
                            {!! Form::text('vl_bc_icms', isset($nota->vl_bc_icms) ? $nota->vl_bc_icms:'0,00', ['id'=>'vl_bc_icms','class'=>'form-control text-right mascara-monetaria']) !!}
                         </div>    
                          <div class="form-group col-md-2 ui-widget">
                            {!! Form::label('l.vl_icms', 'Vlr icms R$') !!}
                            {!! Form::text('vl_icms', isset($nota->vl_icms) ? $nota->vl_icms:'0,00', ['id'=>'vl_icms','class'=>'form-control text-right mascara-monetaria']) !!}
                         </div>    
                      </div>    
                      <div class="row">
                          <div class="form-group col-md-2">
                            {!! Form::label('l.vl_pis', 'Vlr pis R$') !!}
                            {!! Form::text('vl_pis', isset($nota->vl_pis) ? $nota->vl_pis:'0,00', ['id'=>'vl_pis','class'=>'form-control text-right mascara-monetaria']) !!}
                          </div>    
                          <div class="form-group col-md-2 ui-widget">
                            {!! Form::label('l.vl_cofins', 'Vlr cofins R$') !!}
                            {!! Form::text('vl_cofins', isset($nota->vl_cofins) ? $nota->vl_cofins:'0,00', ['id'=>'vl_cofins','class'=>'form-control text-right mascara-monetaria']) !!}
                         </div>    
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
                      <div class="row">
                          <div class="form-group col-md-4 ui-widget">
                            <!-- Numero da nota, campo não disponível na view -->
                            {!! Form::text('num_doc',0, ['id'=>'num_doc','class'=>'form-control hidden']) !!}
                            {!! Form::label('l.cod_cli', 'Código') !!}
                            {!! Form::text('cli_cod', isset($nota->participante_id) ? $nota->participante->codigo:null, ['id'=>'cli_cod','autocomplete'=>'off','class'=>'form-control','placeholder'=>'código para pesquisa...']) !!}
                         </div>    
                         <div class="form-group col-md-8 ui-widget">
                            <!-- Id do participante, campo não disponível na view -->
                            {!! Form::text('participante_id',isset($nota->participante_id) ? $nota->participante_id:0, ['id'=>'participante_id','class'=>'form-control hidden']) !!}
                            {!! Form::label('l.cli_nome', 'Destinatário') !!}
                            {!! Form::text('cli_nome', isset($nota->participante_id) ? $nota->participante->nome:null, ['id'=>'cli_nome','class'=>'form-control','placeholder'=>'nome para pesquisa...']) !!}
                         </div>    
                      </div>
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="pull-right">
                                  <button class="btn btn-default previous-tab" type="button"><span class="glyphicon glyphicon-chevron-left"></span> Anterior</button>
                                  <button id = "gerar" class="btn btn-default next-tab" type="submit"><span class="glyphicon glyphicon-chevron-ok"></span> Gerar</button>
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
            $previous_tab.tab('show');    
        });
        
        // Exibir mascaras
        $('#qtd').maskMoney('mask');
        $('#vl_item').maskMoney('mask');
        $('#aliq_icms').maskMoney('mask');
        $('#vl_desc').maskMoney('mask');
        $('#qtd_item').maskMoney('mask');
        $('#vl_merc').maskMoney('mask');
        $('#vl_doc').maskMoney('mask');
        $('#vl_bc_icms').maskMoney('mask');
        $('#vl_icms').maskMoney('mask');
        $('#vl_pis').maskMoney('mask');
        $('#vl_cofins').maskMoney('mask');
        // Desabilitar inputs da aba somatório
        $('#qtd_item').attr("disabled", true);
        $('#vl_merc').attr("disabled", true);
        $('#vl_doc').attr("disabled", true);
        $('#vl_bc_icms').attr("disabled", true);
        $('#vl_icms').attr("disabled", true);
        $('#vl_doc').attr("disabled", true);
        $('#vl_pis').attr("disabled", true);
        $('#vl_cofins').attr("disabled", true);
        $("#gerar").click(function(e) {
          // Habilitar inputs da aba somatório
          $('#qtd_item').attr("disabled", false);
          $('#vl_merc').attr("disabled", false);
          $('#vl_doc').attr("disabled", false);
          $('#vl_bc_icms').attr("disabled",false);
          $('#vl_icms').attr("disabled", false);
          $('#vl_doc').attr("disabled", false);
          $('#vl_pis').attr("disabled", false);
          $('#vl_cofins').attr("disabled", false);
          // Retirar mascaras
          $("#qtd_item").val($("#qtd_item").maskMoney('unmasked')[0]);
          $("#vl_merc").val($("#vl_merc").maskMoney('unmasked')[0]);
          $("#vl_doc").val($("#vl_doc").maskMoney('unmasked')[0]);
          $("#vl_bc_icms").val($("#vl_bc_icms").maskMoney('unmasked')[0]);
          $("#vl_icms").val($("#vl_icms").maskMoney('unmasked')[0]);
          $("#vl_pis").val($("#vl_pis").maskMoney('unmasked')[0]);
          $("#vl_cofins").val($("#vl_cofins").maskMoney('unmasked')[0]);
        });
    });    
  </script>
@endpush

