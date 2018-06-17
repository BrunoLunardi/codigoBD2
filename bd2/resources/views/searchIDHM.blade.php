@extends('layouts.app') @section('content')
<div class="container">
  <div class="row">
    <div class="col-md-offset-1">
      <div class="animatedLong fadeIn delay15">
        <form action="{{''}}" method="GET">
          <!-- FORMULÁRIO DE PESQUISA -->
          <h3>Nome Município:</h3>
          <input name='nome_municipio' type="text">
          <h3>Nome Estado:</h3>
          <input name='nome_estado' type="text">
          <h3>Ano:</h3>
          <input name='ano' type="number">
          <h3>Classificação:</h3>
          <input name='classificacao' type="number">
          <input type="submit" value="Pesquisar" class="btn btn-primary">
        </form>

        {{ Form::open(array('action' => 'selectController@searchIDHM')) }}


        <div class="form-group">
            {{ Form::label('name', 'Your Name') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'E-mail Address') }}
            {{ Form::text('email', null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}

        {{ Form::close() }}
      </div>
      <div class="panel-group" style="text-align: center; width: 1000px; margin:0 auto;">

        <div class="panel panel-success animatedLong fadeIn">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Cidade</th>
                <th scope="col">Valor</th>
                <th scope="col">Valo{{ Form::open(array('action' => 'selectController@searchIDHM')) }}


                <div class="form-group">
                    {{ Form::label('name', 'Your Name') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'E-mail Address') }}
                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                </div>

                {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}

                {{ Form::close() }}r1</th>
                <th scope="col">Valor2</th>
                <th scope="col">Valor3</th>
              </tr>
            </thead>
            <tbody>

              @foreach($tables as $tupla)
              <tr>
                @foreach($tupla as $collum)
                <td> {{$collum}} </td>
                @endforeach
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
