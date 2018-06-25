@extends('layouts.app') @section('content')
<div class="container">

  <div style='width: 1000px; margin:0 auto;' class="panel panel-primary">

    <div class="panel-body">
      {{ Form::open(array('action' => 'selectController@geoEstadual')) }}


      <div class="form-group">
        {{ Form::select('indice', ['idh' => 'IDH', 'analf' => 'Anafalbetismo', 'mort' => 'Mortalidade', 'renda' => 'Renda per Capita'], 'idh')}}
      </div>


            <div class="form-group">
              {{ Form::select('ano', ['1991' => '1991', '2000' => '2000', '2010' => '2010'], '1991')}}
            </div>
      {{ Form::submit('Submit', ['class' => 'btn btn-info']) }} {{ Form::close() }}

    </div>
    @if ($mostraGrafico)
    <div class="panel-heading">
      <h1>Geo Relatorio de {{$titulo}} em {{$ano}}</div>
  <div class= "panel-body"> <div id="pop-div"></div> </div>
  @geochart('Popularity', 'pop-div')
  @endif

</div>

</div>
@endsection
