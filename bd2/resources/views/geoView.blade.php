@extends('layouts.app') @section('content')
<div class="container">

<div class="panel panel-success animatedLong fadeIn">
  <div id="pop-div"></div>
  @geochart('Popularity', 'pop-div')
</div>

</div>
@endsection
