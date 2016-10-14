@extends('layouts.lte')

@section('content')
<div class="container-fluid">
    @if (Auth::guest())
	    <div class="row">
	      <div class="col-md-12">
	        <div class="panel panel-primary">
	            <div class="panel-heading">Usuário não logado</div>
	            <div class="panel-body">
	            	<a href="{{ url('/login') }}"><span>Executar login</span></a>
	            </div>
	        </div>
	      </div>
	    </div>
    @else
	    <div class="row">
	      <div class="col-md-12">
	        <div class="panel panel-primary">
	            <div class="panel-heading">Bem vindo!</div>
	            <div class="panel-body">
         	          <p>{{ Auth::user()->name }}</p>
	            </div>
	        </div>
	      </div>
	    </div>
	@endif    
</div>
@endsection
