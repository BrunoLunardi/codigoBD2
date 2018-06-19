@extends('layouts.app') @section('content')
<div class="container">
  <div class="panel-group" style="text-align: center; margin-left: 125px;">
    <table>
      <tr>
        <td style="padding: 8px;">
          <div class="panel panel-info animatedLong fadeIn">
            <table>
              <div class="panel-heading animatedLong fadeInDown" style="text-align: center;"><i class="material-icons" style="font-size:50px;">school</i>
                <h3>Banco de Dados</div>
  <div class="panel-body animatedLong fadeInDown" style="text-align: center;">
      <tr>
  <td style="padding: 8px;"> <a href="{{'index.php/searchIDH/'}}" class="btn btn-primary" style="width: 200px;">IDH</a> </td>
    <td style="padding: 8px;"> <a href="{{'index.php/searchIDHM/'}}" class="btn btn-primary" style="width: 200px;">IDH Municipal</a> </td>
    <tr>
    <td style="padding: 8px;"> <a href="{{'index.php/searchMortMun/'}}" class="btn btn-primary" style="width: 200px;">Mortalidade Município</a> </td>
    <td style="padding: 8px;"> <a href="{{'index.php/searchMortEst/'}}" class="btn btn-primary" style="width: 200px;">Mortalidade Estadual</a> </td>
    <tr>
      <td style="padding: 8px;"> <a href="{{'index.php/searchAnalfMun/'}}" class="btn btn-primary" style="width: 200px;">Anafalbetismo Municipal</a> </td>
        <td style="padding: 8px;"> <a href="{{'index.php/searchAnalfEst/'}}" class="btn btn-primary" style="width: 200px;">Anafalbetismo Estadual</a> </td>
        <tr>
          <td style="padding: 8px;"> <a href="{{'index.php/searchRendaPCapMun/'}}" class="btn btn-primary" style="width: 200px;">Renda/Capita Municipal</a> </td>
            <td style="padding: 8px;"> <a href="{{'index.php/searchRendaPCapEst/'}}" class="btn btn-primary" style="width: 200px;">Renda/Capita Estadual</a> </td>


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
        <td><a href="{{'index.php/historicoIDHM/'}}" class="btn btn-success" style="width: 200px;">historico IDHM</a></td>
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



@endsection
