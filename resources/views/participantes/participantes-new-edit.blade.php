@extends('layouts.lte')
@section('title', 'Participantes')
@section('ref')
  <li><a href="{{url('participante?id='.$rotina_id.',&user_id='.$user_id)}}">Participantes</a></li>
@endsection
@if(isset($participante->id) )
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
      <div class="box box-primary">
          @if(isset($participante->id) )
              {!! Form::open(['route'=>['participante.update', $participante->id]]) !!}
          @else
              {!! Form::open(['route'=>'participante.store']) !!}
          @endif
          {!! csrf_field() !!}
          <!-- Nome Form Input -->
          <div class="box-body">
              <div class="row">
                  <div class="form-group col-md-2">
                    {!! Form::label('l.codigo', 'Código') !!}
                    {!! Form::text('codigo', isset($participante->codigo) ? $participante->codigo:null,  ['class'=>'form-control']) !!}
                  </div>    
                  <div class="form-group col-md-10">
                    {!! Form::label('l.nome', 'Razão Social') !!}
                    {!! Form::text('nome', isset($participante->nome) ? $participante->nome:null, ['class'=>'form-control']) !!}
                 </div>    
              </div>    
              <div class="row">
                <div class="form-group col-md-10">
                  {!! Form::label('l.endereco', 'Endereço') !!}
                  {!! Form::text('endereco', isset($participante->endereco) ? $participante->endereco:null, ['class'=>'form-control']) !!}
                </div>    
                <div class="form-group col-md-2">
                  {!! Form::label('l.numero', 'Número') !!}
                  {!! Form::text('numero', isset($participante->numero) ? $participante->numero:null, ['class'=>'form-control']) !!}
                </div>    
              </div>    
              <div class="row">
                <div class="form-group col-md-4">
                  {!! Form::label('l.complemento', 'Complemento') !!}
                  {!! Form::text('complemento', isset($participante->complemento) ? $participante->complemento:null, ['class'=>'form-control']) !!}
                </div>    
                <div class="form-group col-md-4">
                  {!! Form::label('l.bairro', 'Bairro') !!}
                  {!! Form::text('bairro', isset($participante->bairro) ? $participante->bairro:null, ['class'=>'form-control']) !!}
                </div>    
                <div class="form-group col-md-4">
                  {!! Form::label('l.cidade', 'Cidade') !!}
                  {!! Form::text('municipio', isset($participante->municipio) ? $participante->municipio:null, ['class'=>'form-control']) !!}
                </div>    
              </div>    
              <div class="row">
                <div class="form-group col-md-2">
                  {!! Form::label('l.uf', 'UF') !!}
                  {!! Form::text('uf', isset($participante->uf) ? $participante->uf:null, ['class'=>'form-control']) !!}
                </div>    
                <div class="form-group col-md-2">
                  {!! Form::label('l.pais_id', 'Cep') !!}
                  {!! Form::text('cep', isset($participante->cep) ? $participante->cep:null, ['class'=>'form-control']) !!}
                </div>    
                <div class="form-group col-md-2">
                  {!! Form::label('l.ibge', 'Código IBGE') !!}
                  {!! Form::text('ibge', isset($participante->ibge) ? $participante->ibge:null, ['class'=>'form-control']) !!}
                </div>    
                <div class="form-group col-md-2">
                  {!! Form::label('l.pais', 'País') !!}
                  {!! Form::text('pais', isset($participante->pais) ? $participante->pais:null, ['class'=>'form-control']) !!}
                </div>    
                <div class="form-group col-md-2">
                  {!! Form::label('l.cpais', 'Código do País') !!}
                  {!! Form::text('cpais', isset($participante->cpais) ? $participante->cpais:null, ['class'=>'form-control']) !!}
                </div>    
                <div class="form-group col-md-2">
                  {!! Form::label('l.pais_id', 'Telefone') !!}
                  {!! Form::text('fone', isset($participante->fone) ? $participante->fone:null, ['class'=>'form-control']) !!}
                </div>    
              </div>    
              <div class="row">
                <div class="form-group col-md-2">
                  {!! Form::label('l.pessoa', 'Pessoa') !!}
                  {!! Form::select('pessoa', array('F' => 'Fisica', 'J' => 'Jurica'), 'J', ['class'=>'pessoa form-control']) !!}
                </div>    
                <div class="form-group col-md-2">
                  {!! Form::label('l.cpf', 'C.P.F') !!}
                  {!! Form::text('cpf', isset($participante->cpf) ? $participante->cpf:null, ['class'=>'cpf form-control']) !!}
                </div>    
                <div class="form-group col-md-2">
                  {!! Form::label('l.cnpj', 'C.N.P.J') !!}
                  {!! Form::text('cnpj', isset($participante->cnpj) ? $participante->cnpj:null, ['class'=>'cnpj form-control']) !!}
                </div>    
                <div class="form-group col-md-2">
                  {!! Form::label('l.ie', 'Insc. estadual') !!}
                  {!! Form::text('ie', isset($participante->ie) ? $participante->ie:null, ['class'=>'ie form-control']) !!}
                </div>
                <div class="form-group col-md-2">
                  {!! Form::label('l.suframa', 'SUFRAMA') !!}
                  {!! Form::text('suframa', isset($participante->suframa) ? $participante->suframa:null, ['class'=>'form-control']) !!}
                </div>    
                <div class="form-group col-md-2">
                  {!! Form::label('l.tipo', 'Tipo') !!}
                  {!! Form::text('tipo', isset($participante->tipo) ? $participante->tipo:null, ['class'=>'form-control']) !!}
                </div>    
              </div>    
              <div class="row">
                <div class="form-group col-md-6">
                  {!! Form::label('l.email', 'Email') !!}
                  {!! Form::text('email', isset($participante->email) ? $participante->email:null, ['class'=>'form-control']) !!}
                </div>    
                <div class="form-group col-md-2">
                  {!! Form::label('l.nbsp', '&nbsp;') !!}
                  {!! Form::submit('Gravar', ['class'=>'btn btn-default form-control']) !!}
                </div>
              </div>
          </div>  
          {!! Form::close() !!}
      </div>
   </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(".alert").fadeTo(5000, 0.4).slideUp(700, function(){
      $(".alert").alert('close');
    });
    $(".pessoa").change(function(){
      var tipo = $( ".pessoa" ).val();
      if (tipo == "J") {
        $(".cpf").attr("disabled", "disabled");
        $(".cnpj").removeAttr("disabled");       
        $(".ie").removeAttr("disabled");       
        $(".cnpj").focus();       
      } else {
        $(".cpf").removeAttr("disabled");       
        $(".cnpj").attr("disabled", "disabled");
        $(".ie").attr("disabled", "disabled");
        $(".cpf").focus();       
      }  
    })
  </script>
@endpush

