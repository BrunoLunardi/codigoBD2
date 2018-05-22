<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class selectController extends Controller
{
		public function index(Request $request){

			if($request['tName'] != NULL)
			{

			$sql = 'select * from ';
			$sql .= $request['tName'];

		 	$table = DB::select($sql);

		 	if($table == null)
		 		echo "Tabela Nula";

		 	return view('selectView',['tables'=>$table]);
		}
	}

	public function teste(Request $request){
			$str = preg_split('~,~',request('auxiliar'));

			for($i = 0; $i < 4; $i++) {
				if($str[$i] == NULL){
					echo 'I CUZAO';
				}
					echo $str[$i];
					echo '<br>';
			}
	}

	public function searchIDHM(Request $request){
		$search = new selectController();

		$sql = 'select indicativos_municipio.*, municipio.nome_municipio, estado.nome_estado,municipio.id_estado
		from indicativos_municipio
		inner join municipio
		on municipio.id_municipio = indicativos_municipio.id_municipio
		inner join estado
		on municipio.id_estado = estado.id_estado';

		if(request()->has('search') && request('search') != ',,,'){
			$sql .= ' where';
			$searchFilters = preg_split('~,~',request('search'));
			$needAND = false;

			if($searchFilters[0] != NULL){
				$sql .= ' municipio.nome_municipio = '.$searchFilters[0];
			}

			if($searchFilters[1] != NULL){
				if($searchFilters[0] != NULL){
					$sql .= ' AND';
				}
	  		$sql .= ' estado.nome_estado = '.$searchFilters[1];
			}

			if($searchFilters[2] != NULL){
				if($searchFilters[1] != NULL || $searchFilters[0] != NULL){
					$sql .= ' AND';
				}
	  		$sql .= ' indicativos_municipio.ano = '.$searchFilters[2];
			}

			if($searchFilters[3] != NULL){
				if($searchFilters[2] != NULL || $searchFilters[1] != NULL || $searchFilters[0] != NULL){
					$sql .= ' AND';
				}
	  		$sql .= ' indicativos_municipio.classificacao = '.$searchFilters[3];
			}
		}

		$result = DB::select($sql);

			return view('selectView',['tables'=>$result]);

	}

	private function findEstadoID($eName){
		$sql = 'select id_estado from estado where nome_estado = ';
		$sql .= $eName;
		return DB::select($sql);
	}

	private function findMunicioID($mName){
		$sql = 'select id_municipio from municipio where nome_municipio = ';
		$sql .= $mName;
		return DB::select($sql);
	}
}
