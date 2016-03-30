@extends('layouts.app')

@section('content')
  {!! $dataTable->table() !!}
@endsection

@push('scripts')
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
  <script src="/vendor/datatables/buttons.server-side.js"></script>
  {!! $dataTable->scripts() !!}
@stop
