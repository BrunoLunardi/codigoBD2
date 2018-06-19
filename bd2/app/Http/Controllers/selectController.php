<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


use App\Util;

use App\Http\Controllers\Graficos; // Controlador dos graficos

use Khill\Lavacharts\Lavacharts;
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

    //Relatorio 1 PRONTO

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
            array_push($where, ['nome_municipio','LIKE', $searchFilters[0]]);
        }

        if ($searchFilters[1] != null) {
            array_push($where, ['sigla','LIKE', $searchFilters[1]]);
        }

        if ($searchFilters[2] != null) {
            array_push($where, ['ano','=', $searchFilters[2]]);
        }

        if ($searchFilters[3] != null) {
            array_push($where, ['classificacao','LIKE', $searchFilters[3]]);
        }
        $result =	vwconsidhm::where($where)->orderBy($searchFilters[0])->get();

        return view('searchIDHM', ['tables'=>$result]);
    }
    //Relatorio 2 PRONTO
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

        $titulo = 'Titulo';
        if ($nomeMun!='null') {
            $titulo = 'Histórico de IDHM em '.$nomeMun;
        } else {
            $titulo = '-1';
        }
        \Lava::LineChart('historicoIDHM', $historico, [

                                        'height' => '300'

                ]);

        return view('historicoIDHMView', ['tables'=>$result,'titulo'=>$titulo]);
    }

    //Relatorio 3 PRONTO
    public function searchIDH(Request $request)
    {
        $where = array();


        $searchFilters = array(
                                $request->input('nome_estado'),
                                $request->input('ano'),
                                $request->input('classificacao'),
                        );


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

        return view('searchIDH', ['tables'=>$result]);
    }
    //Relatorio 4
    public function searchHistoricoIDH(Request $request)
    {
        $result = vwhistoricoidh::where('nome_estado', $request->input('nomeEstado'))->get();

                $historico = \Lava::DataTable();
                $historico->addDateColumn('Ano')
                        ->addNumberColumn('IDH')
                        ->setDateTimeFormat('Y');
                $nomeMun = 'null';
                foreach ($result as $row) {
                    $historico->addRow(array(
                                strval($row->ano),$row->tidh));
                    $nomeMun = $row->nome_municipio;
                }

                $titulo = 'Titulo';
                if ($nomeMun!='null') {
                    $titulo = 'Histórico de IDH em '.$nomeMun;
                } else {
                    $titulo = '-1';
                }
                \Lava::LineChart('historicoIDHM', $historico, [

                                                'height' => '300'

                        ]);

                return view('historicoIDHView', ['tables'=>$result,'titulo'=>$titulo]);}

    //Relatorio 5 PRONTO
    public function searchMortMun(Request $request)
    {
        $where = array();


        $searchFilters = array(
                                $request->input('nome_municipio'),
                                $request->input('sigla'),
                                $request->input('ano'),

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

        $result = vwconsmortmun::where($where)->get();
        //$result = vwconsmortmun::where($where)->orderBy($searchFilters[0])->get();


        return view('searchMortMun', ['tables'=>$result]);
    }

    //Relatorio 6
    public function searchHistoricoMortMun(Request $request)
    {
        $result = vwhistoricomortmun::where('nome_municipio', $request->input('nomeMunicipio'))->get();

                $historico = \Lava::DataTable();
                $historico->addDateColumn('Ano')
                        ->addNumberColumn('IDH')
                        ->setDateTimeFormat('Y');
                $nomeMun = 'null';
                foreach ($result as $row) {
                    $historico->addRow(array(
                                strval($row->ano),$row->tmortalidade_municipio));
                    $nomeMun = $row->nome_municipio;
                }

                $titulo = 'Titulo';
                if ($nomeMun!='null') {
                    $titulo = 'Histórico de Mortalidade em '.$nomeMun;
                } else {
                    $titulo = '-1';
                }
                \Lava::LineChart('historicoIDHM', $historico, [

                                                'height' => '300'

                        ]);

                return view('historicoMortMun', ['tables'=>$result,'titulo'=>$titulo]);}

    //Relatorio 7 PRONTO
    public function searchMortEst(Request $request)
    {
        $where = array();

        $searchFilters = array(   $request->input('nome_estado'),
                                                $request->input('ano'),
                                        );



        if ($searchFilters[0] != null) {
            array_push($where, ['nome_estado','LIKE', $searchFilters[0]]);
        }

        if ($searchFilters[1] != null) {
            array_push($where, ['ano','=', $searchFilters[1]]);
        }

        //    $result = vwconsmortest::where($where)->orderBy($searchFilters[0])->get();
        $result = vwconsmortest::where($where)->get();


        return view('searchMortEst', ['tables'=>$result]);


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
        $result = vwconsanalfmun::where('nome_estado', $request->input('nomeEstado'))->get();

                $historico = \Lava::DataTable();
                $historico->addDateColumn('Ano')
                        ->addNumberColumn('IDH')
                        ->setDateTimeFormat('Y');
                $nomeMun = 'null';
                foreach ($result as $row) {
                    $historico->addRow(array(
                                strval($row->ano),$row->tmortalidade_estado));
                    $nomeMun = $row->nome_municipio;
                }

                $titulo = 'Titulo';
                if ($nomeMun!='null') {
                    $titulo = 'Histórico de Mortalidade em '.$nomeMun;
                } else {
                    $titulo = '-1';
                }
                \Lava::LineChart('historicoIDHM', $historico, [

                                                'height' => '300'

                        ]);

                return view('historicoMortEst', ['tables'=>$result,'titulo'=>$titulo]);}

    //Relatorio 9 PRONTO
    public function searchAnalfMun(Request $request)
    {
        $where = array();


        $searchFilters = array(
                                                $request->input('nome_municipio'),
                                                  $request->input('sigla'),
                                                $request->input('ano'),

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

        //$result =	vwconsanalfmun::where($where)->orderBy($searchFilters[0])->get();
        $result =	vwconsanalfmun::where($where)->get();

        return view('searchAnalfMun', ['tables'=>$result]);
    }

    //Relatorio 10
    public function searchHistoricoAnalfMun(Request $request)
    {
        $result = vwconsanalfmun::where('nome_municipio', $request->input('nomeMunicipio'))->get();
        //FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)

                $historico = \Lava::DataTable();
                $historico->addDateColumn('Ano')
                        ->addNumberColumn('IDH')
                        ->setDateTimeFormat('Y');
                $nomeMun = 'null';
                foreach ($result as $row) {
                    $historico->addRow(array(
                                strval($row->ano),$row->searchHistoricoAnalfMun));
                    $nomeMun = $row->nome_municipio;
                }

                $titulo = 'Titulo';
                if ($nomeMun!='null') {
                    $titulo = 'Histórico de Analfabetismo em '.$nomeMun;
                } else {
                    $titulo = '-1';
                }
                \Lava::LineChart('historicoIDHM', $historico, [

                                                'height' => '300'

                        ]);

                return view('historicoAnalfMun', ['tables'=>$result,'titulo'=>$titulo]);}

    //Relatorio 11 PRONTO
    public function searchAnalfEst(Request $request)
    {
        $where = array();
        $searchFilters = array(
                                                        $request->input('nome_estado'),
                                                        $request->input('ano'),
                                                );

        if ($searchFilters[0] != null) {
            array_push($where, ['nome_estado','LIKE', '%'.$searchFilters[1].'%']);
        }

        if ($searchFilters[1] != null) {
            array_push($where, ['ano','=', $searchFilters[2]]);
        }

        //    $result =	vwconsanalfest::where($where)->orderBy($searchFilters[0])->get();
        $result =	vwconsanalfest::where($where)->get();
        return view('searchAnalfEst', ['tables'=>$result]);
    }

    //Relatorio 12
    public function searchHistoricoAnalfEst(Request $request)
    {
        $result = vwconsanalfest::where('nome_estado', $request->input('nomeEstado'))->get();
        //FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)

                $historico = \Lava::DataTable();
                $historico->addDateColumn('Ano')
                        ->addNumberColumn('IDH')
                        ->setDateTimeFormat('Y');
                $nomeMun = 'null';
                foreach ($result as $row) {
                    $historico->addRow(array(
                                strval($row->ano),$row->tanalfabetismo_estado));
                    $nomeMun = $row->nome_municipio;
                }

                $titulo = 'Titulo';
                if ($nomeMun!='null') {
                    $titulo = 'Histórico de Analfabetismo em '.$nomeMun;
                } else {
                    $titulo = '-1';
                }
                \Lava::LineChart('historicoIDHM', $historico, [

                                                'height' => '300'

                        ]);

                return view('historicoAnalfEst', ['tables'=>$result,'titulo'=>$titulo]);
    }

    //Relatorio 13
    public function searchRendaPCapMun(Request $request)
    {
        $where = array();

        $searchFilters = array(
                                                        $request->input('nome_municipio'),
                                                        $request->input('sigla'),
                                                        $request->input('ano'),

                                                );

        if ($searchFilters[0] != null) {
            array_push($where, ['nome_municipio','LIKE', '%'.$searchFilters[0].'%']);
        }

        if ($searchFilters[1] != null) {
            array_push($where, ['sigla','LIKE', $searchFilters[1]]);
        }

        if ($searchFilters[2] != null) {
            array_push($where, ['ano','=', $searchFilters[2]]);
        }

        //    $result =	vwconsrendapcapmun::where($where)->orderBy($searchFilters[0])->get();
        $result =	vwconsrendapcapmun::where($where)->get();
        return view('searchRendaPCapMun', ['tables'=>$result]);
    }

    //Relatorio 14
    public function searchHistoricoRendaPCapMun(Request $request)
    {
        $result = vwconsrendapcapmun::where('nome_municipio', $request->input('nomeMunicipio'))->get();
        //FACA UM GRAFICO COM ESSAS INFORMACOES (OLHAR DRE)

                $historico = \Lava::DataTable();
                $historico->addDateColumn('Ano')
                        ->addNumberColumn('IDH')
                        ->setDateTimeFormat('Y');
                $nomeMun = 'null';
                foreach ($result as $row) {
                    $historico->addRow(array(
                                strval($row->ano),$row->trendapercapita_municipio));
                    $nomeMun = $row->nome_municipio;
                }

                $titulo = 'Titulo';
                if ($nomeMun!='null') {
                    $titulo = 'Histórico de Renda em '.$nomeMun;
                } else {
                    $titulo = '-1';
                }
                \Lava::LineChart('historicoIDHM', $historico, [

                                                'height' => '300'

                        ]);

                return view('historicoRendaMun', ['tables'=>$result,'titulo'=>$titulo]);    //ALGUM RETURN QUE VAI PRA VIEW
    }

    //Relatorio 15
    public function searchRendaPCapEst(Request $request)
    {
        $where = array();

        $searchFilters = array(
                        $request->input('nome_estado'),
                        $request->input('ano'),
                        );

        if ($searchFilters[0] != null) {
            array_push($where, ['nome_estado','LIKE', '%'.$searchFilters[0].'%']);
        }

        if ($searchFilters[1] != null) {
            array_push($where, ['ano','=', $searchFilters[1]]);
        }

        //$util = new Util();
        //$util->exportToCSV($result, array('Estado','Renda Per Capita','Ano'), 'RendaPerCapitaEstadual.csv', array('nome_estado','trendapercapita_estado','ano'));
        //$result =	vwconsrendapcapest::where($where)->orderBy($searchFilters[0])->get();
        $result =	vwconsrendapcapest::where($where)->get();

        return view('searchRendaPCapEst', ['tables'=>$result]);
    }

    //Relatorio 16
    public function searchHistoricoRendaPCapEst(Request $request)
    {
        $result = vwconsrendapcapest::where('nome_estado', $request->input('nomeEstado'))->get();

                $historico = \Lava::DataTable();
                $historico->addDateColumn('Ano')
                        ->addNumberColumn('IDH')
                        ->setDateTimeFormat('Y');
                $nomeMun = 'null';
                foreach ($result as $row) {
                    $historico->addRow(array(
                                strval($row->ano),$row->trendapercapita_estado));
                    $nomeMun = $row->nome_municipio;
                }

                $titulo = 'Titulo';
                if ($nomeMun!='null') {
                    $titulo = 'Histórico de IDHM em '.$nomeMun;
                } else {
                    $titulo = '-1';
                }
                \Lava::LineChart('historicoIDHM', $historico, [

                                                'height' => '300'

                        ]);

                return view('historicoRendaEst', ['tables'=>$result,'titulo'=>$titulo]);    //ALGUM RETURN QUE VAI PRA VIEW
    }
}
