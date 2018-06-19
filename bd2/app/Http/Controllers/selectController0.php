<?php
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
