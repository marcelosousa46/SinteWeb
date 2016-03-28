@extends('layouts.lte')

@if( isset($usuario->id) )
  @section('title', 'Usuários - alteração')
@else
  @section('title', 'Usuários - inclusão')
@endif

@section('content')
    <nav>
      <ul class="pager">
        <li class="previous"><a href="{{url('usuarios')}}"><span aria-hidden="true">&larr;</span>voltar</a></li>
      </ul>
    </nav>
    <div class="box box-primary">
      <div class="box-header with-border">
        @if( isset($setor->id) )
            {!! Form::open(['route'=>['usuarios.update', $usuario->id]]) !!}
        @else
            {!! Form::open(['route'=>'usuarios.store']) !!}
        @endif

        <!-- Nome Form Input -->
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('nome', 'Nome:') !!}
                {!! Form::text('name', isset($usuario->name) ? $usuario->name:null, ['class'=>'form-control']) !!}
                {!! Form::label('email', 'E-Mail:') !!}
                {!! Form::text('email', isset($usuario->email) ? $usuario->email:null, ['class'=>'form-control']) !!}
                {!! Form::label('Senha', 'Senha:') !!}
                {!! Form::password('password', isset($usuario->password) ? $usuario->email:null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Confirmar', ['class'=>'btn btn-primary']) !!}
            </div>
         </div>

        {!! Form::close() !!}
      </div>
  </div>

@endsection
