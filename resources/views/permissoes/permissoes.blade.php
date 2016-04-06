@extends('layouts.lte')
@section('title', 'Permissões')
@section('ref')
  <li><class="active">'Permissões'</li>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        @if (session('status'))
          <div class="alert alert-danger fade in">
            <h4>Atenção!</h4>
            {{ session('status') }}
          </div>
        @endif
      </div>
    </div>
  
    <div class="row">
      <div class="col-md-10">
        <div class="box box-primary">
          <div class="box-header with-border">
            <div class="box-body">
              {!! Form::open(['route'=>'permissoes.create']) !!}
              {!! csrf_field() !!}
              <!-- Nome Form Input -->
                <div class="form-group">
                    @for($i = 0; $i < count($menu); $i++)
                        <label class="checkbox margem-chekbox-20">
                          <input type="checkbox" id="menu" value="option1"> {{ $menu[$i]->descricao }}
                        </label>        
                        @for($j = 0; $j < count($submenu); $j++)
                           @if ($submenu[$j]->nivel == $menu[$i]->nivel)
                              <label class="checkbox margem-chekbox-40">
                                <input type="checkbox" id="submenu" value="option1">{{ $submenu[$j]->descricao }}
                              </label>        
                           @endif   
                        @endfor 
                    @endfor
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
  </div>

@stop
@push('scripts')
  <script>
    $(".alert").fadeTo(2000, 0.4).slideUp(700, function(){
      $(".alert").alert('close');
    });
  </script>
@endpush
