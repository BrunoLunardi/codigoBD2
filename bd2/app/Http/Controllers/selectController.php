<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Util;

use App\Http\Controllers\Graficos; // Controlador dos graficos

//Modelos
use App\vwconsidhm;//Relatorio 1 - Model
use App\vwhistoricoidhm;//Relatorio 2 - Model
use App\vwconsidh;//Relatorio 3 - Model
use App\vwhistoricoidh;//Relatorio 4 - Model
use App\vwconsmortmun;//Relatorio 5 - Model
use App\vwhistoricomortmun;//Relatorio 6 - Model
use App\vwconsmortest;//Relatorio 7 e 8 - Model
use App\vwconsanalfmun;//Relatorio 9 e 10 - Model
use App\vwconsanalfest;//Relatorio 11 e 12 - Model
use App\vwconsrendapcapmun;//Relatorio 13 e 14 - Model
use App\vwconsrendapcapest;//Relatorio 15 e 16 - Model

class selectController extends Controller
{
	public function index(Request $request){

			if($request['tName'] != NULL)
			{

			$where = 'select * from ';
			$where .= $request['tName'];

		 	$table = DB::select($where);

		 	if($table == null)
		 		echo "Tabela Nula";

		 	return view('selectView',['tables'=>$table]);
		}
	}

	public function teste(Request $request){
			$teste = vwconsidhm::all();

			foreach($teste as $row){
				echo $row->id_estado;
				echo " | ";
				echo $row->nome_estado;
				echo " | ";
				echo $row->id_municipio;
				echo " | ";
				echo $row->nome_municipio;
				echo " | ";
				echo $row->tmortalidade_municipio;
				echo " | ";
				echo $row->tanalfabetismo_municipio;
				echo " | ";
				echo $row->tidhm;
				echo " | ";
				echo $row->trendapercapita_municipio;
				echo " | ";
				echo $row->ano;
				echo " | ";
				echo $row->classificacao;
				echo "<br>";
			}
	}

//Relatorio 1
	public function searchIDHM(Request $request){
		$where = array();

		if(request('search') != ',,,,'){
			$searchFilters = preg_split('~,~',request('search'));

			if($searchFilters[1] != NULL){
				array_push($where,['nome_municipio','LIKE', '%'.$searchFilters[1].'%']);
			}

			if($searchFilters[2] != NULL){
	  		array_push($where,['sigla','LIKE', $searchFilters[2]]);
			}

			if($searchFilters[3] != NULL){
	  		array_push($where,['ano','LIKE', $searchFilters[3]]);
			}

			if($searchFilters[4] != NULL){
	  		array_push($where,['classificacao','LIKE', '%'.$searchFilters[4].'%']);
			}

			if($searchFilters[0] == '-')
				$result =	vwconsidhm::where ($where)->get();
			else $result =	vwconsidhm::where ($where)->orderBy($searchFilters[0])->get();

		}
		else {
		$result = vwconsidhm::all();
		}
		$graficos = new Graficos();
		$graficos->graficoLinha($result);
	}

//Relatorio 3
	public function searchIDH(Request $request){
		$where = array();

		if(request('search') != ',,,'){
			$searchFilters = preg_split('~,~',request('search'));

			if($searchFilters[1] != NULL){
				array_push($where,['nome_estado','LIKE', '%'.$searchFilters[1].'%']);
			}

			if($searchFilters[2] != NULL){
	  		array_push($where,['ano','LIKE', $searchFilters[2]]);
			}

			if($searchFilters[3] != NULL){
	  		array_push($where,['classificacao','LIKE', '%'.$searchFilters[3].'%']);
			}

			if($searchFilters[0] == '-')
				$result =	vwconsidh::where ($where)->get();
			else $result = vwconsidh::where ($where)->orderBy($searchFilters[0])->get();

			foreach($result as $row){
				echo $row->nome_estado;
				echo $row->idh;
				echo $row->ano;
				echo $row->classificacao;
				echo '<br>';
			}

			return;
			//return view('selectView',['tables'=>$result]);
		}

		$result = vwconsidh::all();
		foreach($result as $row){
			echo $row->nome_estado;
			echo $row->idh;
			echo $row->ano;
			echo $row->classificacao;
			echo '<br>';
		}
		//return view('selectView',['tables'=>$result]);
	}

//Relatorio 2
	public function searchHistoricoIDHM(Request $request){
		$result = vwhistoricoidhm::where ('nome_municipio',request('nomeMunicipio'))->get();

		//FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)
		foreach($result as $row){
			echo $row->nome_municipio;
			echo $row->idhm;
			echo $row->ano;
			echo '<br>';
		}
		//ALGUM RETURN QUE VAI PRA VIEW
	}

//Relatorio 4
	public function searchHistoricoIDH(Request $request){
		$result = vwhistoricoidh::where ('nome_estado',request('nomeEstado'))->get();

		//FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)
		foreach($result as $row){
			echo $row->nome_estado;
			echo $row->idh;
			echo $row->ano;
			echo '<br>';
		}
		//ALGUM RETURN QUE VAI PRA VIEW
	}

//Relatorio 5
	public function searchMortMun(Request $request){
		$where = array();

		if(request('search') != ',,,'){
			$searchFilters = preg_split('~,~',request('search'));

			if($searchFilters[1] != NULL){
				array_push($where,['nome_municipio','LIKE', '%'.$searchFilters[1].'%']);
			}

			if($searchFilters[2] != NULL){
	  		array_push($where,['sigla','LIKE', $searchFilters[2]]);
			}

			if($searchFilters[3] != NULL){
	  		array_push($where,['ano','LIKE', $searchFilters[3]]);
			}

			if($searchFilters[0] == '-')
				$result =	vwconsmortmun::where ($where)->get();
			else $result =	vwconsmortmun::where ($where)->orderBy($searchFilters[0])->get();

			foreach($result as $row){
				echo $row->nome_municipio;
				echo $row->sigla;
				echo $row->tmortalidade_municipio;
				echo $row->ano;
				echo '<br>';
			}
			return;
			//return view('selectView',['tables'=>$result]);
		}

		$result = vwconsmortmun::all();
		foreach($result as $row){
			echo $row->nome_municipio;
			echo $row->sigla;
			echo $row->tmortalidade_municipio;
			echo $row->ano;
			echo '<br>';
		}
		//return view('selectView',['tables'=>$result]);
	}

//Relatorio 6
	public function searchHistoricoMortMun(Request $request){
		$result = vwhistoricomortmun::where ('nome_municipio',request('nomeMunicipio'))->get();

		//FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)
		foreach($result as $row){
			echo $row->nome_municipio;
			echo $row->tmortalidade_municipio;
			echo $row->ano;
			echo '<br>';
		}
		//ALGUM RETURN QUE VAI PRA VIEW
	}

//Relatorio 7
	public function searchMortEst(Request $request){
		$where = array();

		if(request('search') != ',,'){
			$searchFilters = preg_split('~,~',request('search'));

			if($searchFilters[1] != NULL){
				array_push($where,['nome_estado','LIKE', '%'.$searchFilters[1].'%']);
			}

			if($searchFilters[2] != NULL){
	  		array_push($where,['ano','LIKE', $searchFilters[2]]);
			}

			if($searchFilters[0] == '-')
				$result =	vwconsmortest::where ($where)->get();
			else $result =	vwconsmortest::where ($where)->orderBy($searchFilters[0])->get();

			foreach($result as $row){
				echo $row->nome_estado;
				echo $row->tmortalidade_estado;
				echo $row->ano;
				echo '<br>';
			}
			return;
			//return view('selectView',['tables'=>$result]);
		}

		$result = vwconsmortest::all();
		foreach($result as $row){
			echo $row->nome_estado;
			echo $row->tmortalidade_estado;
			echo $row->ano;
			echo '<br>';
		}
		//return view('selectView',['tables'=>$result]);
	}

//Relatorio 8
	public function searchHistoricoMortEst(Request $request){
		$result = vwconsanalfmun::where ('nome_estado',request('nomeEstado'))->get();
			//FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)
		foreach($result as $row){
			echo $row->nome_estado;
			echo $row->tmortalidade_estado;
			echo $row->ano;
			echo '<br>';
		}
		//ALGUM RETURN QUE VAI PRA VIEW
	}

//Relatorio 9
	public function searchAnalfMun(Request $request){
		$where = array();
		if(request('search') != ',,,'){
			$searchFilters = preg_split('~,~',request('search'));

			if($searchFilters[1] != NULL){
				array_push($where,['nome_municipio','LIKE', '%'.$searchFilters[1].'%']);
			}

			if($searchFilters[2] != NULL){
	  		array_push($where,['nome_estado','LIKE', '%'.$searchFilters[2].'%']);
			}

			if($searchFilters[3] != NULL){
	  		array_push($where,['ano','LIKE', $searchFilters[3]]);
			}

			if($searchFilters[0] == '-')
				$result =	vwconsanalfmun::where ($where)->get();
			else $result =	vwconsanalfmun::where ($where)->orderBy($searchFilters[0])->get();

			foreach($result as $row){
				echo $row->nome_municipio;
				echo $row->sigla;
				echo $row->tanalfabetismo_municipio;
				echo $row->ano;
				echo '<br>';
			}
			return;
			//return view('selectView',['tables'=>$result]);
		}

		$result = vwconsanalfmun::all();

		foreach($result as $row){
			echo $row->nome_municipio;
			echo $row->sigla;
			echo $row->tanalfabetismo_municipio;
			echo $row->ano;
			echo '<br>';
		}
		//return view('selectView',['tables'=>$result]);
	}

//Relatorio 10
	public function searchHistoricoAnalfMun(Request $request){
		$result = vwconsanalfmun::where ('nome_municipio',request('nomeMunicipio'))->get();
		//FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)
  	foreach($result as $row){
	  	echo $row->nome_municipio;
			echo $row->tanalfabetismo_municipio;
			echo $row->ano;
			echo '<br>';
		}
		//ALGUM RETURN QUE VAI PRA VIEW
	}

//Relatorio 11
	public function searchAnalfEst(Request $request){
		$where = array();
		if(request('search') != ',,'){
			$searchFilters = preg_split('~,~',request('search'));

			if($searchFilters[1] != NULL){
				array_push($where,['nome_estado','LIKE', '%'.$searchFilters[1].'%']);
			}

			if($searchFilters[2] != NULL){
	  		array_push($where,['ano','LIKE', $searchFilters[2]]);
			}

			if($searchFilters[0] == '-')
				$result =	vwconsanalfest::where ($where)->get();
			else $result =	vwconsanalfest::where ($where)->orderBy($searchFilters[0])->get();

			foreach($result as $row){
				echo $row->nome_estado;
				echo $row->tanalfabetismo_estado;
				echo $row->ano;
				echo '<br>';
			}
			return;
			//return view('selectView',['tables'=>$result]);
		}

		$result = vwconsanalfest::all();

		foreach($result as $row){
			echo $row->nome_estado;
			echo $row->tanalfabetismo_estado;
			echo $row->ano;
			echo '<br>';
		}
		//return view('selectView',['tables'=>$result]);
	}

//Relatorio 12
	public function searchHistoricoAnalfEst(Request $request){
		$result = vwconsanalfest::where ('nome_estado',request('nomeEstado'))->get();
		//FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)
  	foreach($result as $row){
	  	echo $row->nome_estado;
			echo $row->tanalfabetismo_estado;
			echo $row->ano;
			echo '<br>';
		}
		//ALGUM RETURN QUE VAI PRA VIEW
	}

//Relatorio 13
	public function searchRendaPCapMun(Request $request){
		$where = array();
		if(request('search') != ',,,'){
			$searchFilters = preg_split('~,~',request('search'));

			if($searchFilters[1] != NULL){
				array_push($where,['nome_municipio','LIKE', '%'.$searchFilters[1].'%']);
			}

			if($searchFilters[2] != NULL){
				array_push($where,['sigla','LIKE', $searchFilters[2]]);
			}

			if($searchFilters[3] != NULL){
	  		array_push($where,['ano','LIKE', $searchFilters[3]]);
			}

			if($searchFilters[0] == '-')
				$result =	vwconsrendapcapmun::where ($where)->get();
			else $result =	vwconsrendapcapmun::where ($where)->orderBy($searchFilters[0])->get();

			foreach($result as $row){
 				echo $row->nome_municipio;
				echo $row->sigla;
				echo $row->trendapercapita_municipio;
				echo $row->ano;
				echo '<br>';
			}
			return;
			//return view('selectView',['tables'=>$result]);
		}

		$result = vwconsrendapcapmun::all();

		foreach($result as $row){
			echo $row->nome_municipio;
			echo $row->sigla;
			echo $row->trendapercapita_municipio;
			echo $row->ano;
			echo '<br>';
		}
		//return view('selectView',['tables'=>$result]);
	}

//Relatorio 14
	public function searchHistoricoRendaPCapMun(Request $request){
		$result = vwconsrendapcapmun::where ('nome_municipio',request('nomeMunicipio'))->get();
		//FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)
		foreach($result as $row){
			echo $row->nome_municipio;
			echo $row->sigla;
			echo $row->trendapercapita_municipio;
			echo $row->ano;
			echo '<br>';
		}
		//ALGUM RETURN QUE VAI PRA VIEW
	}

//Relatorio 15
	public function searchRendaPCapEst(Request $request){
		$where = array();
		if(request('search') != ',,'){
			$searchFilters = preg_split('~,~',request('search'));

			if($searchFilters[1] != NULL){
				array_push($where,['nome_estado','LIKE', '%'.$searchFilters[1].'%']);
			}

			if($searchFilters[2] != NULL){
	  		array_push($where,['ano','LIKE', $searchFilters[2]]);
			}

			if($searchFilters[0] == '-')
				$result =	vwconsrendapcapest::where ($where)->get();
			else $result =	vwconsrendapcapest::where ($where)->orderBy($searchFilters[0])->get();
/*
			foreach($result as $row){
 				echo $row->nome_estado;
				echo $row->trendapercapita_estado;
				echo $row->ano;
				echo '<br>';
			}*/
			$util = new Util();
			$util->exportToCSV($result,array('Estado','Renda Per Capita','Ano'),'RendaPerCapitaEstadual.csv',array('nome_estado','trendapercapita_estado','ano'));

			return;
			//return view('selectView',['tables'=>$result]);
		}

		$result = vwconsrendapcapest::all();

		/*
		foreach($result as $row){
			echo $row->nome_estado;
			echo $row->trendapercapita_estado;
			echo $row->ano;
			echo '<br>';
		}*/

		$util = new Util();
		$util->exportToCSV($result,array('Estado','Renda Per Capita','Ano'),'RendaPerCapitaEstadual.csv',array('nome_estado','trendapercapita_estado','ano'));
		//return view('selectView',['tables'=>$result]);
	}

//Relatorio 16
	public function searchHistoricoRendaPCapEst(Request $request){
		$result = vwconsrendapcapest::where ('nome_estado',request('nomeEstado'))->get();
		//FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)
  	foreach($result as $row){
	  	echo $row->nome_estado;
			echo $row->trendapercapita_estado;
			echo $row->ano;
			echo '<br>';
		}
		//ALGUM RETURN QUE VAI PRA VIEW
	}

}
