@extends('layouts.lte')
@section('title', 'Permissões')
@section('ref')
  <li><a href="{{url('permissoes?id='.$rotina_id)}}">Permissões</a></li>
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
              {!! Form::open(['route'=>['permissoes.update', $permissao->id]]) !!}
          @else
              {!! Form::open(['route'=>'permissoes.store']) !!}
          @endif
          {!! csrf_field() !!}
          <!-- Nome Form Input -->
          <div class="box-body">
              <div class="form-group">
                  @if(isset($permissao->users_id))
                      {!! Form::label('id_usuario', 'Usuário:'.$username) !!}
                      {!! Form::text('users_id', isset($permissao->users_id) ? $permissao->users_id:null, ['class'=>'form-control tamanho-campo-120', 'disabled']) !!}
                      {!! Form::label('rotinas_id', 'Rotina:'.$rotinadescricao) !!}
                      {!! Form::text('rotinas_id', isset($permissao->rotinas_id) ? $permissao->rotinas_id:null, ['class'=>'form-control tamanho-campo-120', 'disabled']) !!}
                  @else
                      {!! Form::label('id_usuario', 'Usuário:') !!}
                      {!! Form::text('users_id', isset($permissao->users_id) ? $permissao->users_id:null, ['class'=>'form-control tamanho-campo-120']) !!}
                      {!! Form::label('rotinas_id', 'Rotina:') !!}
                      {!! Form::text('rotinas_id', isset($permissao->rotinas_id) ? $permissao->rotinas_id:null, ['class'=>'form-control tamanho-campo-120']) !!}
                    @endif                    
                  {!! Form::label('liberado', 'Acesso total:') !!}
                  <div class="form-group">
                      {!! Form::select('liberado', array('A' => 'Permitido', 'B' => 'Bloqueado'),isset($permissao->liberado) ? $permissao->liberado:'A', ['class'=>'form-control tamanho-campo-120']) !!}                  
                  </div>    
                  {!! Form::label('incluir', 'Inclusão:') !!}
                  <div class="form-group">
                      {!! Form::select('incluir', array('A' => 'Permitido', 'B' => 'Bloqueado'),isset($permissao->incluir) ? $permissao->incluir:'A', ['class'=>'form-control tamanho-campo-120']) !!}                  
                  </div>    
                  {!! Form::label('alterar', 'Alteração:') !!}
                  <div class="form-group">
                      {!! Form::select('alterar', array('A' => 'Permitido', 'B' => 'Bloqueado'),isset($permissao->alterar) ? $permissao->alterar:'A', ['class'=>'form-control tamanho-campo-120']) !!}
                  </div>    
                  {!! Form::label('consultar', 'Consulta:') !!}
                  <div class="form-group">
                      {!! Form::select('consultar', array('A' => 'Permitido', 'B' => 'Bloqueado'),isset($permissao->consultar) ? $permissao->consultar:'A', ['class'=>'form-control tamanho-campo-120']) !!}
                  </div>    
                  {!! Form::label('excluir', 'Exclusão:') !!}
                  <div class="form-group">
                      {!! Form::select('excluir', array('A' => 'Permitido', 'B' => 'Bloqueado'),isset($permissao->excluir) ? $permissao->excluir:'A', ['class'=>'form-control tamanho-campo-120']) !!}
                  </div>    
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
