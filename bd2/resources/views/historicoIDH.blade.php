@extends('layouts.app') @section('content')
<div class="container">

  <div style='width: 1000px; margin:0 auto;' class="panel panel-primary">
    <div class="panel-body">
      {{ Form::open(array('action' => 'selectController@searchHistoricoIDH')) }}


      <div class="form-group">
        {{ Form::label('nome_estado1', 'Nome do Estado:') }} {{ Form::text('nome_estado1', null, ['class' => 'form-control']) }}
          {{ Form::label('nome_estado2', 'Nome do Estado:') }} {{ Form::text('nome_estado2', null, ['class' => 'form-control']) }}
            {{ Form::label('nome_estado3', 'Nome do Estado:') }} {{ Form::text('nome_estado3', null, ['class' => 'form-control']) }}
      </div>
      {{ Form::submit('Submit', ['class' => 'btn btn-info']) }} {{ Form::close() }}

    </div>
    @if ($titulo!= -1)
    <div class="panel-heading">
      <h1>{{$titulo}}</div>
        <div id="pop-div" class= "panel-body">

  <div id="pop-div" class= "panel-body"></div>
  @linechart('historicoIDHM', 'pop-div')
  </div>

          <div class="panel panel-success animatedLong fadeIn">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Estado</th>
                  <th scope="col">IDH</th>
                  <th scope="col">Ano</th>

                </tr>
              </thead>
              <tbody>

                @foreach($tables as $row)
                <tr>
                  <td> {{$row->nome_estado}} </td>
                  <td> {{$row->tidh}}</td>
                  <td> {{$row->ano}}</td>
                </tr>

                @endforeach
              </tbody>
            </table>

          </div>
  @endif

</div>
@endsection
