@extends('layouts.lte')
@section('title', 'Gêneros')
@section('ref')
  <li><a href="{{url('generos?id='.$rotina_id.',&user_id='.$user_id)}}">Gêneros</a></li>
@endsection
@if(isset($genero->id) )
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
          @if(isset($genero->id) )
              {!! Form::open(['route'=>['generos.update', $genero->id]]) !!}
          @else
              {!! Form::open(['route'=>'generos.store']) !!}
          @endif
          {!! csrf_field() !!}
          <!-- Nome Form Input -->
          <div class="box-body">
            <div class="form-group">
                {!! Form::label('l.codigo', 'Código:') !!}
                {!! Form::text('codigo', isset($genero->codigo) ? $genero->codigo:null, ['class'=>'form-control']) !!}
            </div>    
            <div class="form-group">
                {!! Form::label('l.descricao', 'Descrição:') !!}
                {!! Form::text('descricao', isset($genero->descricao) ? $genero->descricao:null, ['class'=>'form-control']) !!}
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
    $(".alert").fadeTo(5000, 0.4).slideUp(700, function(){
      $(".alert").alert('close');
    });
  </script>
@endpush

