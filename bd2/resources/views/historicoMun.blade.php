@extends('layouts.app') @section('content')
<div class="container">
<div style='width: 1000px; margin:0 auto;' class="panel panel-primary">
<div class="panel-body">
{{ Form::open(array('action' => $control)) }}
<div class="form-group">
{{ Form::label('nome_municipio1', 'Nome do Município:') }} {{ Form::text('nome_municipio1', null, ['class' => 'form-control']) }}
{{ Form::label('nome_municipio2', 'Nome do Município:') }} {{ Form::text('nome_municipio2', null, ['class' => 'form-control']) }}
{{ Form::label('nome_municipio3', 'Nome do Município:') }} {{ Form::text('nome_municipio3', null, ['class' => 'form-control']) }}
</div>
{{ Form::submit('Submit', ['class' => 'btn btn-info']) }} {{ Form::close() }}
</div>
</div>
<br>
<div style='width: 1000px; margin:0 auto;' class="panel panel-success animatedLong fadeIn">
@if ($titulo!= -1)
<div class="panel-heading">
<h1>{{$titulo}}
</div>
<div  class= "panel-body">
<div id="pop-div"></div>
@linechart('historicoIDHM', 'pop-div')
</div>
@endif
</div>
</div>

@endsection
