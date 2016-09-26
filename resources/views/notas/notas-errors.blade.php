@extends('layouts.lte')
@section('title', 'Error:')
@section('ref')
  <li><a href="{{url('nota?id='.$rotina_id.',&user_id='.$user_id)}}">Emissão de Notas</a></li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="col-md-12">
    <div class="row">
      <p>verifique os problema(s) abaixo relacionado(s):</p>	
      <ul>
      	@if ($rejeicao == true)
      	  <li>{{ $error['xMotivo'] }}</li>
      	@else  
        @foreach ($error as $erro)
          @foreach ($erro as $err)
	          <li>{{ $err }}</li>
	      @endforeach
        @endforeach
        @endif
      </ul>
    </div>
  </div>
</di>
@stop

@push('scripts')
@endpush