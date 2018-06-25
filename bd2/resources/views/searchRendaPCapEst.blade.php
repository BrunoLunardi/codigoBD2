@extends('layouts.app') @section('content')

<div class="container">
  <div class="row">
    <div class="col-md-offset-1">
      <div class="animatedLong fadeIn">

        <div  class="panel-heading panel-success"style="margin: 50;">
          {{ Form::open(array('action' => 'selectController@searchRendaPCapEst')) }}


          <div class="form-group">
            {{ Form::label('nome_estado', 'Nome do Estado:') }} {{ Form::text('nome_estado', null, ['class' => 'form-control']) }}
          </div>
          <div class="form-group">
            {{ Form::label('ano', 'Ano: ') }} {{ Form::text('ano', null, ['class' => 'form-control']) }}
          </div>
          {{ Form::submit('Buscar', ['class' => 'btn btn-info']) }}


    <table style="margin-top: 10px;">
      <tr>
        <td> {{ Form::submit('Mostrar Tudo', ['class' => 'btn btn-success']) }} {{ Form::close() }} </td>
<td style="padding-left: 10px;"> <a href="{{action('selectController@getCSV')}}" class="btn btn-primary" style="width: 200px;">Exportar para CSV</a> </td>

</tr>
</table>
        </div>
        <div class="panel-group" style="text-align: center; width: 1000px; margin:0 auto;">

          <div class="panel panel-success animatedLong fadeIn delay15">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Estado</th>
                  <th scope="col">Renda</th>
                  <th scope="col">Ano</th>
                </tr>
              </thead>
              <tbody>

                @foreach($tables as $row)
                <tr>
                  <td> {{$row->nome_estado}} </td>
                  <td> {{$row->trendapercapita_estado}}</td>
                  <td> {{$row->ano}}</td>
                </tr>

                @endforeach
              </tbody>
            </table>
  </div>
</div>
      </div>
    </div>
  </div>
  @endsection
