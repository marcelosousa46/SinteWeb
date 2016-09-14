@extends('layouts.lte')
@section('title', 'Produtos')
@section('ref')
  <li><a href="{{url('produtos?id='.$rotina_id.',&user_id='.$user_id)}}">Produtos</a></li>
@endsection
@if(isset($produto->id) )
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
    <div class="box box-primary">
      <div class="box-body">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif        

        @if(isset($produto->id) )
            {!! Form::open(['route'=>['produtos.update', $produto->id]]) !!}
        @else
            {!! Form::open(['route'=>'produtos.store']) !!}
        @endif
        {!! csrf_field() !!}
        <!-- Nome Form Input -->
          <div class="row">
            <div class="form-group col-md-4">
                {!! Form::label('l.codigo', 'Código') !!}
                {!! Form::text('codigo', isset($produto->codigo) ? $produto->codigo:null, ['id'=>'codigo', 'class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-md-8">
                {!! Form::label('l.descricao', 'Descrição') !!}
                {!! Form::text('descricao', isset($produto->descricao) ? $produto->descricao:null, ['class'=>'form-control']) !!}
            </div>    
          </div>  
          <div class="row">
            <div class="form-group col-md-4">
                {!! Form::label('l.codigo_barra', 'Código de barras') !!}
                {!! Form::text('codigo_barra', isset($produto->codigo_barra) ? $produto->codigo_barra:null, ['class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-md-2">
                {!! Form::label('l.codigo_anterior', 'Código anterior') !!}
                {!! Form::text('codigo_anterior', isset($produto->codigo_anterior) ? $produto->codigo_anterior:null, ['class'=>'form-control']) !!}
              </div>
            <div class="form-group col-md-2">
                {!! Form::label('l.id_unidade', 'unidade') !!}
                {!! Form::select('unidade_id', $unidades,isset($produto->unidade_id) ? $produto->unidade_id:'1', ['class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-md-4">
                {!! Form::label('l.id_tipoitem', 'Tipo do item:') !!}
                {!! Form::select('tipoitem_id', $tipoitens,isset($produto->tipoitem_id) ? $produto->tipoitem_id:'1', ['class'=>'form-control']) !!}
            </div>    
          </div>
          <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('l.id_cst', 'CST') !!}
                {!! Form::select('cst', array('00' => '00-Tributada integralmente', 
                                              '10' => '10-Tributada e com cobrança do ICMS por substituição tributária',
                                              '20' => '20-Com redução de base de cálculo', 
                                              '30' => '30-Isenta ou não tributada e com cobrança do ICMS por substituição tributária', 
                                              '40' => '40-Isenta', 
                                              '41' => '41-Não tributada', 
                                              '50' => '50-Suspensão', 
                                              '51' => '51-Diferimento', 
                                              '60' => '60-ICMS cobrado anteriormente por substituição tributária',
                                              '70' => '70-Com redução de base de cálculo e cobrança do ICMS por substituição tributária',
                                              '90' => '90-outras'),
                          isset($produto->cst) ? $produto->cst:'1', ['class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-md-6">
                {!! Form::label('l.id_ncm', 'N.C.M') !!}
                {!! Form::select('ncm_id', $ncms,isset($produto->ncm_id) ? $produto->ncm_id:'1', ['class'=>'form-control']) !!}
            </div>    
          </div>
          <div class="row">
            <div class="form-group col-md-2">
                {!! Form::label('l.id_genero', 'Gênero') !!}
                {!! Form::select('genero_id', $generos,isset($produto->genero_id) ? $produto->genero_id:'1', ['class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-md-2">
                {!! Form::label('l.ipi', 'I.P.I:') !!}
                {!! Form::text('ipi', isset($produto->ipi) ? $produto->ipi:null, ['id'=>'ipi','class'=>'form-control text-right']) !!}
            </div>    
            <div class="form-group col-md-2">
                {!! Form::label('l.icms', 'I.C.M.S:') !!}
                {!! Form::text('icms', isset($produto->icms) ? $produto->icms:null, ['id'=>'icms','class'=>'form-control text-right']) !!}
            </div>    
            <div class="form-group col-md-2">
                {!! Form::label('l.lst', 'L.S.T:') !!}
                {!! Form::text('lst', isset($produto->lst) ? $produto->lst:null, ['id'=>'lst','class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-md-2">
                {!! Form::label('l.preco', 'Preço:') !!}
                {!! Form::text('preco_id', isset($produto->preco_id) ? $produto->preco_id:null, ['id'=>'preco','class'=>'form-control text-right']) !!}
            </div>
            <div class="form-group col-md-2">
                {!! Form::label('l.nbsp', '&nbsp;') !!}
                {!! Form::submit('Confirmar', ['class'=>'btn btn-primary btn-block']) !!}
            </div>
          </div>  
        {!! Form::close() !!}
      </div>
  </div>
 </div>
</div>

@endsection
@push('scripts')
  <script>
    $("#icms").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $("#preco").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    $('#preco').maskMoney('mask')
    $('#icms').maskMoney('mask')
    $('#codigo').focus();

  </script>
@endpush

