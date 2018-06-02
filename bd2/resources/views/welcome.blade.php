@extends('layouts.app') @section('content')
<div class="container">
      <div class="panel-group" style="text-align: center; margin-left: 250px;" >
        <table>
          <tr>
            <td style="padding: 8px;">
              <div class="panel panel-info animatedLong fadeIn">
                <table>
                  <div class="panel-heading animatedLong fadeInDown" style="text-align: center;"><i class="material-icons" style="font-size:50px;">school</i>
                    <h3>Banco de Dados</div>
  <div class="panel-body animatedLong fadeInDown" style="text-align: center;">
      <tr>
    <td style="padding: 8px;"> <a href="/searchIDHM/,,," class="btn btn-primary" style="width: 200px;">Pesquisar</a> </td>
  </table>
</div>
</div>
</td>
<td>

<div class="panel panel-success animatedLong fadeIn">
  <div  class="panel-heading animatedLong fadeInDown"><i class="material-icons" style="font-size:50px;">event_note</i><h3>Relatórios</div>
  <div class="panel-body animatedLong fadeInDown">
    <table>
      <tr>
        <td style="padding: 8px;"><a href="{{'index.php/geoRelatorio'}}" class="btn btn-success" style="width: 200px;">Geo Relatório</a></td>
        <td><a href="{{'index.php/historicoIDH'}}" class="btn btn-success" style="width: 200px;">historicoIDH</a></td>
      </tr>
      <tr>
        <td><a href="" class="btn btn-success" style="width: 200px;">Relatório 3</a></td>
      </tr>
    </table>
</div>
</div>

</td>
</tr>

</table>
            </div>
        </div>

@endsection
