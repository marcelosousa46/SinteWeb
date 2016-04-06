@extends('layouts.lte')
@section('title', 'Rotinas do sistema')
@section('ref')
  <li><a href="{{url('rotinas?id='.$rotina_id)}}">Rotinas</a></li>
@endsection
@if(isset($rotina->id) )
  @section('ref1')
    <li class="active">Alteração</li>
  @endsection
@else
  @section('ref1')
    <li class="active">Inclusão</li>
  @endsection
@endif

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <div class="box box-primary">
        <div class="box-header with-border">
          @if(isset($rotina->id) )
              {!! Form::open(['route'=>['rotinas.update', $rotina->id]]) !!}
          @else
              {!! Form::open(['route'=>'rotinas.store']) !!}
          @endif
          {!! csrf_field() !!}
          <!-- Nome Form Input -->
          <div class="box-body">
              <div class="form-group">
                  {!! Form::label('descricao', 'Descrição:') !!}
                  {!! Form::text('descricao', isset($rotina->descricao) ? $rotina->descricao:null, ['class'=>'form-control']) !!}
                  {!! Form::label('tipo', 'Tipo:') !!}
                  <div class="form-group">
                      {!! Form::select('tipo', array('0' => 'Menu', '1' => 'Submenu'),isset($rotina->tipo) ? $rotina->tipo:'0', ['class'=>'form-control tamanho-campo-120']) !!}                  
                  </div>    
                  {!! Form::label('pai', 'Pai:') !!}
                  {!! Form::text('nivel', isset($rotina->nivel) ? $rotina->nivel:null, ['class'=>'form-control tamanho-campo-120']) !!}
              </div>

              <div class="form-group">
                  {!! Form::submit('Confirmar', ['class'=>'btn btn-primary']) !!}
              </div>
          </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>
 </div>

@endsection
