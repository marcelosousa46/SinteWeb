@extends('layouts.lte')
@section('title', 'Pequisa')
@section('content')
  {{ Form::open(['action' => ['SearchController@searchUser'], 'method' => 'GET']) }}
      {{ Form::text('q', '', ['id' =>  'q', 'placeholder' =>  'Enter name'])}}
      {{ Form::submit('Search', array('class' => 'button expand')) }}
  {{ Form::close() }}

@stop

@push('scripts')
  <script>
    $(function()
    {
       $( "#q" ).autocomplete({
        source: "search/autocomplete",
        minLength: 3,
        select: function(event, ui) {
          $('#q').val(ui.item.value);
        }
      });
    });
  </script>
@endpush
