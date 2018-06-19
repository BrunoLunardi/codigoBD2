<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


use Khill\Lavacharts\Lavacharts;
use App\vwconsidhm;//Relatorio 1 - Model
use App\vwhistoricoidhm;//Relatorio 2 - Model
use App\vwconsidh;//Relatorio 3 - Model
use App\vwhistoricoidh;//Relatorio 4 - Model
use App\vwconsmortmun;//Relatorio 5 - Model
use App\vwhistoricomortmun;//Relatorio 6 - Model
use App\vwconsmortest;//Relatorio 7 e 8 - Model
use App\vwconsanalfmun;//Relatorio 9 e 10 - Model

class selectController extends Controller
{
    public function index(Request $request)
    {
        if ($request['tName'] != null) {
            $where = 'select * from ';
            $where .= $request['tName'];

            $table = DB::select($where);

            if ($table == null) {
                echo "Tabela Nula";
            }

            return view('selectView', ['tables'=>$table]);
        }
    }

    public function teste(Request $request)
    {
        $teste = vwconsidhm::all();

        foreach ($teste as $row) {
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
    public function searchIDHMAll(Request $request)
    {
        $result = vwconsidhm::all();
        return view('searchIDHM', ['tables'=>$result]);
    }
    public function searchIDHM(Request $request)
    {
        $where = array();
        $searchFilters = array(
                $request->input('nome_municipio'),
                $request->input('sigla'),
                $request->input('ano'),
                $request->input('classificacao'),
            );

        if ($searchFilters[0] != null) {
            array_push($where, ['nome_municipio','=', $searchFilters[0]]);
        }

        if ($searchFilters[1] != null) {
            array_push($where, ['sigla','=', $searchFilters[1]]);
        }

        if ($searchFilters[2] != null) {
            array_push($where, ['ano','=', $searchFilters[2]]);
        }

        if ($searchFilters[3] != null) {
            array_push($where, ['classificacao','=', $searchFilters[3]]);
        }
        $result = vwconsidhm::where($where)->get();

        return view('searchIDHM', ['tables'=>$result]);
    }

    //Relatorio 3
    public function searchIDH(Request $request)
    {
        $where = array();

        if (request('search') != ',,') {
            $searchFilters = preg_split('~,~', request('search'));

            if ($searchFilters[0] != null) {
                array_push($where, ['nome_estado','=', $searchFilters[0]]);
            }

            if ($searchFilters[1] != null) {
                array_push($where, ['ano','=', $searchFilters[1]]);
            }

            if ($searchFilters[2] != null) {
                array_push($where, ['classificacao','=', $searchFilters[2]]);
            }

            $result = vwconsidh::where($where)->get();

            foreach ($result as $row) {
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
        foreach ($result as $row) {
            echo $row->nome_estado;
            echo $row->idh;
            echo $row->ano;
            echo $row->classificacao;
            echo '<br>';
        }
        //return view('selectView',['tables'=>$result]);
    }

    //Relatorio 2
    public function searchHistoricoIDHM(Request $request)
    {
        $result = vwhistoricoidhm::where('nome_municipio', $request->input('nome_municipio'))->get(); // rever


				$historico = \Lava::DataTable();
        $historico->addDateColumn('Ano')
                ->addNumberColumn('IDH')
                ->setDateTimeFormat('Y');
$nomeMun = 'null';
        foreach ($result as $row) {
            $historico->addRow(array(
                        strval($row->ano),$row->tidhm));
												$nomeMun = $row->nome_municipio;
        }

        \Lava::LineChart('historicoIDHM', $historico, [
                    'title' => 'Historico de IDHM de '.$nomeMun,
										'height' => '300'

                ]);

        return view('historicoIDHMView',['tables'=>$result]);
    }

    //Relatorio 4
    public function searchHistoricoIDH(Request $request)
    {
        $result = vwhistoricoidh::where('nome_estado', request('nomeEstado'))->get();

        //FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)
        foreach ($result as $row) {
            echo $row->nome_estado;
            echo $row->idh;
            echo $row->ano;
            echo '<br>';
        }
        //ALGUM RETURN QUE VAI PRA VIEW
    }

    //Relatorio 5
    public function searchMortMun(Request $request)
    {
        $where = array();

        if (request('search') != ',,') {
            $searchFilters = preg_split('~,~', request('search'));

            if ($searchFilters[0] != null) {
                array_push($where, ['nome_municipio','=', $searchFilters[0]]);
            }

            if ($searchFilters[1] != null) {
                array_push($where, ['sigla','=', $searchFilters[1]]);
            }

            if ($searchFilters[2] != null) {
                array_push($where, ['ano','=', $searchFilters[2]]);
            }

            $result = vwconsmortmun::where($where)->get();

            foreach ($result as $row) {
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
        foreach ($result as $row) {
            echo $row->nome_municipio;
            echo $row->sigla;
            echo $row->tmortalidade_municipio;
            echo $row->ano;
            echo '<br>';
        }
        //return view('selectView',['tables'=>$result]);
    }

    //Relatorio 6
    public function searchHistoricoMortMun(Request $request)
    {
        $result = vwhistoricomortmun::where('nome_municipio', request('nomeMunicipio'))->get();

        //FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)
        foreach ($result as $row) {
            echo $row->nome_municipio;
            echo $row->tmortalidade_municipio;
            echo $row->ano;
            echo '<br>';
        }
        //ALGUM RETURN QUE VAI PRA VIEW
    }

    //Relatorio 7
    public function searchMortEst(Request $request)
    {
        $where = array();

        if (request('search') != ',') {
            $searchFilters = preg_split('~,~', request('search'));

            if ($searchFilters[0] != null) {
                array_push($where, ['nome_estado','LIKE', $searchFilters[0]]);
            }

            if ($searchFilters[1] != null) {
                array_push($where, ['ano','=', $searchFilters[1]]);
            }

            $result = vwconsmortest::where($where)->get();

            foreach ($result as $row) {
                echo $row->nome_estado;
                echo $row->tmortalidade_estado;
                echo $row->ano;
                echo '<br>';
            }
            return;
            //return view('selectView',['tables'=>$result]);
        }

        $result = vwconsmortest::all();
        foreach ($result as $row) {
            echo $row->nome_estado;
            echo $row->tmortalidade_estado;
            echo $row->ano;
            echo '<br>';
        }
        //return view('selectView',['tables'=>$result]);
    }

    //Relatorio 8
    public function searchHistoricoMortEst(Request $request)
    {
        $result = vwconsanalfmun::where('nome_estado', request('nomeEstado'))->get();
        //FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)
        foreach ($result as $row) {
            echo $row->nome_estado;
            echo $row->tmortalidade_estado;
            echo $row->ano;
            echo '<br>';
        }
        //ALGUM RETURN QUE VAI PRA VIEW
    }

    //Relatorio 9
    public function searchAnalfMun(Request $request)
    {
        $where = array();
        if (request('search') != ',,') {
            $searchFilters = preg_split('~,~', request('search'));

            if ($searchFilters[0] != null) {
                array_push($where, ['nome_municipio','=', $searchFilters[0]]);
            }

            if ($searchFilters[1] != null) {
                array_push($where, ['nome_estado','=', $searchFilters[1]]);
            }

            if ($searchFilters[2] != null) {
                array_push($where, ['ano','=', $searchFilters[2]]);
            }

            $result =	vwconsanalfmun::where($where)->get();

            foreach ($result as $row) {
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

        foreach ($result as $row) {
            echo $row->nome_municipio;
            echo $row->sigla;
            echo $row->tanalfabetismo_municipio;
            echo $row->ano;
            echo '<br>';
        }
        //return view('selectView',['tables'=>$result]);
    }

    //Relatorio 10
    public function searchHistoricoAnalfMun(Request $request)
    {
        $result = vwconsanalfmun::where('nome_municipio', request('nomeMunicipio'))->get();
        //FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)
        foreach ($result as $row) {
            echo $row->nome_municipio;
            echo $row->tanalfabetismo_municipio;
            echo $row->ano;
            echo '<br>';
        }
        //ALGUM RETURN QUE VAI PRA VIEW
    }
}
