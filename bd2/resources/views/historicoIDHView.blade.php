@extends('layouts.app') @section('content')
<div class="container">

  <div style='width: 1000px; margin:0 auto;' class="panel panel-primary">
    <div class="panel-heading">
      <h1>Historico IDH Relatorio</div>
  <div id="pop-div" class= "panel-body"></div>
  @linechart('historicoIDH', 'pop-div')
</div>

</div>
@endsection
