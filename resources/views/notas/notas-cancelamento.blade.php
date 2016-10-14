@extends('layouts.lte')
@section('title', 'Cancelamento da nota')
@section('ref')
  <li><a href="{{url('nota?id='.$rotina_id.',&user_id='.$user_id)}}">Emissão de Notas</a></li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="col-md-12">
    <div class="row">
      {!! Form::open(['id'=>'nota','route'=>['nota.cancela', $nota->id]]) !!}
      {!! csrf_field() !!}
      <div class="box box-primary">
         <div class="box-body">
                  <div class="row">
                    <div class="form-group col-md-12">
                       <p>Destinatário: {{$nota->participante->nome}}</p>
                    </div>
                  </div>     
                  <div class="row">
                    <div class="form-group col-md-12">
                    <p>Data: {{date('d/m/Y', strtotime($nota->dt_doc))}}</p>

                    </div>
                  </div>     
                  <div class="row">
                    <div class="form-group col-md-12">
                    <p>valor: {{number_format($nota->vl_doc, 2, ',', '.')}}</p>
                    </div>
                  </div>     
                  <div class="row">
                      <div class="form-group col-md-12">
                        {!! Form::label('l.dt_doc', 'Motivo') !!}
                        {!! Form::text('motivo', null, ['id'=>'motivo','class'=>'form-control','placeholder'=>'motivo para cancelamento da nota...']) !!}
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="pull-right">
                              <button id = "cancelar" class="btn btn-default next-tab" type="submit"><span class="glyphicon glyphicon-chevron-ok"></span> Confirmar</button>
                          </div>
                      </div>
                  </div>

              </div>
          </div>
      </div>
  </div>
</di>
@stop

@push('scripts')
@endpush