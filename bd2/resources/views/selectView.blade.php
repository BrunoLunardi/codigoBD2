@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-1">
          <div class="animatedLong fadeIn delay15">
                    <form action = "{{route('selectRoute')}}" method="GET"> <!-- FORMULÁRIO DE PESQUISA -->
                      <input name ='search' type="text">
                      <input type="submit" value ="Pesquisar" class ="btn btn-primary">
                  </form>
          				</div>
                <div class="panel-group" style="text-align: center;">

                    <div class="panel panel-success animatedLong fadeIn">
                        <table class="table">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Cidade</th>
                              <th scope="col">Valor</th>
                                <th scope="col">Valor1</th>
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
