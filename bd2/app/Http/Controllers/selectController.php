<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\vwindicativosmunest;

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
			$teste = vwindicativosmunest::all();

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

			$result = vwindicativosmunest::where ($where)->get();

			foreach($where as $aux)
			foreach($aux as $r)
				echo $r;

			foreach($result as $row){
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

			return;

		}

		$result = vwindicativosmunest::all();

				  foreach($result as $row){
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

					return;

//		return view('selectView',['tables'=>$result]);

	}

	private function findEstadoID($eName){
		$where = 'select id_estado from estado where nome_estado = ';
		$where .= $eName;
		return DB::select($where);
	}

	private function findMunicioID($mName){
		$where = 'select id_municipio from municipio where nome_municipio = ';
		$where .= $mName;
		return DB::select($where);
	}
}
