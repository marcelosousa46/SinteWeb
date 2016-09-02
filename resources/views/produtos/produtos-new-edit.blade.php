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
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-primary">
        <div class="box-header with-border">
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
          <div class="box-body">
            <div class="form-group col-lg-6">
                {!! Form::label('l.codigo', 'Código:') !!}
                {!! Form::text('codigo', isset($produto->codigo) ? $produto->codigo:null, ['id'=>'codigo', 'class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-lg-6">
                {!! Form::label('l.descricao', 'Descrição:') !!}
                {!! Form::text('descricao', isset($produto->descricao) ? $produto->descricao:null, ['class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-lg-6">
                {!! Form::label('l.codigo_barra', 'Código de barras:') !!}
                {!! Form::text('codigo_barra', isset($produto->codigo_barra) ? $produto->codigo_barra:null, ['class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-lg-6">
                {!! Form::label('l.codigo_anterior', 'Código anterior:') !!}
                {!! Form::text('codigo_anterior', isset($produto->codigo_anterior) ? $produto->codigo_anterior:null, ['class'=>'form-control']) !!}
            <div class="form-group col-lg-6">
                {!! Form::label('l.id_unidade', 'unidade:') !!}
                {!! Form::select('unidade_id', $unidades,isset($produto->unidade_id) ? $produto->unidade_id:'1', ['class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-lg-6">
                {!! Form::label('l.id_tipoitem', 'Tipo do item:') !!}
                {!! Form::select('tipoitem_id', $tipoitens,isset($produto->tipoitem_id) ? $produto->tipoitem_id:'1', ['class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-lg-6">
                {!! Form::label('l.id_ncm', 'N.C.M:') !!}
                {!! Form::select('ncm_id', $ncms,isset($produto->ncm_id) ? $produto->ncm_id:'1', ['class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-lg-6">
                {!! Form::label('l.id_genero', 'Gênero:') !!}
                {!! Form::select('genero_id', $generos,isset($produto->genero_id) ? $produto->genero_id:'1', ['class'=>'form-control']) !!}
            </div>    
            <div class="form-group col-lg-6">
                {!! Form::label('l.ipi', 'I.P.I:') !!}
                {!! Form::text('ipi', isset($produto->ipi) ? $produto->ipi:null, ['class'=>'form-control tamanho-campo-120']) !!}
            </div>    
            <div class="form-group col-lg-6">
                {!! Form::label('l.icms', 'I.C.M.S:') !!}
                {!! Form::text('icms', isset($produto->icms) ? $produto->icms:null, ['class'=>'form-control tamanho-campo-120']) !!}
            </div>    
            <div class="form-group col-lg-6">
                {!! Form::label('l.lst', 'L.S.T:') !!}
                {!! Form::text('lst', isset($produto->lst) ? $produto->lst:null, ['class'=>'form-control tamanho-campo-120']) !!}
            </div>    
            <div class="form-group col-lg-6">
                {!! Form::label('l.preco', 'Preço:') !!}
                {!! Form::text('preco_id', isset($produto->preco_id) ? $produto->preco_id:null, ['class'=>'form-control tamanho-campo-120']) !!}
            </div>
            <div class="form-group col-lg-6">
                {!! Form::submit('Confirmar', ['class'=>'btn btn-primary']) !!}
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
     $("#codigo").focus();
     $(".alert").fadeTo(5000, 0.4).slideUp(700, function(){
     $(".alert").alert('close');
    });
    $(function($){
       $("#real").maskMoney({symbol:"R$",decimal:",",thousands:"."});
       $("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
       $("#phone").mask("(999) 999-9999");
       $("#tin").mask("99-9999999");
       $("#ssn").mask("999-99-9999");
    });    
  </script>
@endpush

