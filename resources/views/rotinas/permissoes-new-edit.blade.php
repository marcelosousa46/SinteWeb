@extends('layouts.lte')
@section('title', 'Permissões')
@section('ref')
  <li><a href="{{url('permissoes')}}">Permissões</a></li>
@endsection
@if(isset($usuario->id) )
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
          @if(isset($usuario->id) )
              {!! Form::open(['route'=>['usuarios.update', $usuario->id]]) !!}
          @else
              {!! Form::open(['route'=>'usuarios.store']) !!}
          @endif
          {!! csrf_field() !!}
          <!-- Nome Form Input -->
          <div class="box-body">
              <div class="form-group">
                  {!! Form::label('nome', 'Nome:') !!}
                  {!! Form::text('name', isset($usuario->name) ? $usuario->name:null, ['class'=>'form-control']) !!}
                  {!! Form::label('email', 'E-Mail:') !!}
                  {!! Form::text('email', isset($usuario->email) ? $usuario->email:null, ['class'=>'form-control']) !!}
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
