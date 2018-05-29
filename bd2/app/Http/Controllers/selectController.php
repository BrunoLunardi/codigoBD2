<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\vwconsidhm;
use App\vwhistoricoidhm;
use App\vwconsidh;

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

	public function searchIDHM(Request $request){
		$where = array();

		if(request('search') != ',,,'){
			$searchFilters = preg_split('~,~',request('search'));

			if($searchFilters[0] != NULL){
				array_push($where,['nome_municipio','=', $searchFilters[0]]);
			}

			if($searchFilters[1] != NULL){
	  		array_push($where,['nome_estado','=', $searchFilters[1]]);
			}

			if($searchFilters[2] != NULL){
	  		array_push($where,['ano','=', $searchFilters[2]]);
			}

			if($searchFilters[3] != NULL){
	  		array_push($where,['classificacao','=', $searchFilters[3]]);
			}

			$result = vwconsidhm::where ($where)->get();
			return view('selectView',['tables'=>$result]);
		}

		$result = vwconsidhm::all();
		return view('selectView',['tables'=>$result]);
	}

	public function searchIDH(Request $request){
		$where = array();

		if(request('search') != ',,'){
			$searchFilters = preg_split('~,~',request('search'));

			if($searchFilters[0] != NULL){
				array_push($where,['nome_estado','=', $searchFilters[0]]);
			}

			if($searchFilters[1] != NULL){
	  		array_push($where,['ano','=', $searchFilters[1]]);
			}

			if($searchFilters[2] != NULL){
	  		array_push($where,['classificacao','=', $searchFilters[2]]);
			}

			$result = vwconsidh::where ($where)->get();

			foreach($result as $row){
				echo $row->nome_estado;
				echo $row->idh;
				echo $row->ano;
				echo $row->classificacao;
				echo '<br>';
			}

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
}
