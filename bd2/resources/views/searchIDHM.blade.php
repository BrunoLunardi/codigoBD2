@extends('layouts.app') @section('content')
<div class="container">
  <div class="row">
    <div class="col-md-offset-1">
      <div class="animatedLong fadeIn">

        <div  class="panel-heading panel-success"style="margin: 50;">
          {{ Form::open(array('action' => 'selectController@searchIDHM')) }}


          <div class="form-group">
            {{ Form::label('nome_municipio', 'Nome do Município:') }} {{ Form::text('nome_municipio', null, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ Form::label('sigla', 'Estado:') }} {{ Form::text('sigla', null, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ Form::label('ano', 'Ano: ') }} {{ Form::text('ano', null, ['class' => 'form-control']) }}
          </div>

          <div class="form-group">
            {{ Form::label('classificacao', 'Classificação: ') }} {{ Form::text('classificacao', null, ['class' => 'form-control']) }}
          </div>
          {{ Form::submit('Buscar', ['class' => 'btn btn-info']) }} {{ Form::close() }}
          <br>

        </div>
        <div class="panel-group" style="text-align: center; width: 1000px; margin:0 auto;">

          <div class="panel panel-success animatedLong fadeIn delay15">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Município</th>
                  <th scope="col">Estado</th>
                  <th scope="col">IDHM</th>
                  <th scope="col">Ano</th>
                  <th scope="col">Classificação</th>
                </tr>
              </thead>
              <tbody>

                @foreach($tables as $row)
                <tr>
                  <td> {{$row->nome_municipio}} </td>
                  <td> {{$row->sigla}}</td>
                  <td> {{$row->tidhm}}</td>
                  <td> {{$row->ano}}</td>
                  <td> {{$row->classificacao}}</td>
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
