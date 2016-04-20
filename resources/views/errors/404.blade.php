@extends('layouts.lte')
@section('title', 'Error: 404')
@section('inclusao')
  <li class="item-inclusao"><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Início</a></li>
@endsection
@section('ref')
  <li><class="active">voltar</li>
@endsection

@section('content')
<div class="alert alert-danger col-lg-6">
  <ul>
      <li>Página não localizada</li>
  </ul>
</div>
@stop

@push('scripts')
  <script>
    $(".alert").fadeTo(5000, 0.4).slideUp(700, function(){
      $(".alert").alert('close');
    });
  </script>
@endpush
