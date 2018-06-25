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
    private $csvData;
    private $csvTable;
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
        $teste = vwconsidhm::where('nome_municipio', "Abaiara")->get();

        if (count($teste) != 0) {
            echo $teste[0]->nome_municipio;
        }
        /* foreach ($teste as $row) {
            echo $row->id_municipio;
            echo " | ";
            echo $row->nome_municipio;
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
        */
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
        $result =	vwconsidhm::where($where)->get();

        session(['csvVar' => array('nome_municipio','tidhm','ano')]);
        session(['csvData' => array('Municipio','IDHM','Ano')]);
        session(['csvTitle' => 'IDHMunicipal.csv']);
        session(['csvTable' => $result]);

        return view('searchIDHM', ['tables'=>$result]);
    }
    //Relatorio 2 PRONTO
    public function searchHistoricoIDHM(Request $request)
    {
            $result1 = vwhistoricoidhm::where('nome_municipio', $request->input('nome_municipio1'))->get();
            $result2 = vwhistoricoidhm::where('nome_municipio', $request->input('nome_municipio2'))->get();
            $result3 = vwhistoricoidhm::where('nome_municipio', $request->input('nome_municipio3'))->get();

            return $this->graficoLMun($result1, $result2, $result3, 'idh', 'IDH', 'selectController@searchHistoricoIDHM');
    }

    //Relatorio 3 PRONTO
    public function searchIDH(Request $request)
    {
        $where = array();


        $searchFilters = array(
                                $request->input('nome_municipio'),
                                $request->input('ano'),
                                $request->input('classificacao'),
                        );


        if ($searchFilters[0] != null) {
            array_push($where, ['nome_municipio','=', $searchFilters[0]]);
        }

        if ($searchFilters[1] != null) {
            array_push($where, ['ano','=', $searchFilters[1]]);
        }

        if ($searchFilters[2] != null) {
            array_push($where, ['classificacao','=', $searchFilters[2]]);
        }

        $result = vwconsidh::where($where)->get();


        session(['csvVar' => array('nome_municipio','tidh','ano')]);
        session(['csvTitle' => 'IDHEstadual.csv']);
        session(['csvData' => array('Estado','IDH','Ano')]);
        session(['csvTable' => $result]);


        return view('searchIDH', ['tables'=>$result]);
    }
    //Relatorio 4
    public function searchHistoricoIDH(Request $request)
    {
        $result1 = vwhistoricoidh::where('nome_municipio', $request->input('nome_municipio1'))->get();
        $result2 = vwhistoricoidh::where('nome_municipio', $request->input('nome_municipio2'))->get();
        $result3 = vwhistoricoidh::where('nome_municipio', $request->input('nome_municipio3'))->get();

        return $this->graficoLEst($result1, $result2, $result3, 'idh', 'IDH', 'selectController@searchHistoricoIDH');
    }

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


        session(['csvVar' => array('nome_municipio','tmortalidade_municipio','ano')]);
        session(['csvData' => array('Municipio','Mortalidade','Ano')]);
        session(['csvTitle' => 'MortalidadeMunicipal.csv']);
        session(['csvTable' => $result]);

        return view('searchMortMun', ['tables'=>$result]);
    }

    //Relatorio 6
    public function searchHistoricoMortMun(Request $request)
    {

            $result1 = vwhistoricomortmun::where('nome_municipio', $request->input('nome_municipio1'))->get();
            $result2 = vwhistoricomortmun::where('nome_municipio', $request->input('nome_municipio2'))->get();
            $result3 = vwhistoricomortmun::where('nome_municipio', $request->input('nome_municipio3'))->get();

            return $this->graficoLMun($result1, $result2, $result3, 'mort', 'Mortalidade', 'selectController@searchHistoricoMortMun');
    }

    //Relatorio 7 PRONTO
    public function searchMortEst(Request $request)
    {
        $where = array();

        $searchFilters = array(   $request->input('nome_municipio'),
                                                $request->input('ano'),
                                        );



        if ($searchFilters[0] != null) {
            array_push($where, ['nome_municipio','LIKE', $searchFilters[0]]);
        }

        if ($searchFilters[1] != null) {
            array_push($where, ['ano','=', $searchFilters[1]]);
        }

        //    $result = vwconsmortest::where($where)->orderBy($searchFilters[0])->get();
        $result = vwconsmortest::where($where)->get();


        session(['csvVar' => array('nome_municipio','tmortalidade_municipio','ano')]);
        session(['csvTitle' => 'MortalidadeEstadual.csv']);
        session(['csvData' => array('Estado','Mortalidade','Ano')]);
        session(['csvTable' => $result]);

        return view('searchMortEst', ['tables'=>$result]);

        //return view('selectView',['tables'=>$result]);
    }

    //Relatorio 8
    public function searchHistoricoMortEst(Request $request)
    {
        $result1 = vwconsmortest::where('nome_municipio', $request->input('nome_municipio1'))->get();
        $result2 = vwconsmortest::where('nome_municipio', $request->input('nome_municipio2'))->get();
        $result3 = vwconsmortest::where('nome_municipio', $request->input('nome_municipio3'))->get();

        return $this->graficoLEst($result1, $result2, $result3, 'mort', 'Mortalidade', 'selectController@searchHistoricoMortEst');
    }

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


        session(['csvVar' => array('nome_municipio','tanalfabetismo_municipio','ano')]);
        session(['csvData' => array('Municipio','Anafalbetismo','Ano')]);
        session(['csvTitle' => 'AnafalbetismoMunicipal.csv']);
        session(['csvTable' => $result]);

        return view('searchAnalfMun', ['tables'=>$result]);
    }

    //Relatorio 10
    public function searchHistoricoAnalfMun(Request $request)
    {
        $result = vwconsanalfmun::where('nome_municipio', $request->input('nome_municipio'))->get();

            $result1 = vwconsanalfmun::where('nome_municipio', $request->input('nome_municipio1'))->get();
            $result2 = vwconsanalfmun::where('nome_municipio', $request->input('nome_municipio2'))->get();
            $result3 = vwconsanalfmun::where('nome_municipio', $request->input('nome_municipio3'))->get();

            return $this->graficoLMun($result1, $result2, $result3, 'analf', 'Anafalbetismo', 'selectController@searchHistoricoAnalfMun');
    }

    //Relatorio 11 PRONTO
    public function searchAnalfEst(Request $request)
    {
        $where = array();
        $searchFilters = array(
                                                        $request->input('nome_municipio'),
                                                        $request->input('ano'),
                                                );

        if ($searchFilters[0] != null) {
            array_push($where, ['nome_municipio','LIKE', '%'.$searchFilters[1].'%']);
        }

        if ($searchFilters[1] != null) {
            array_push($where, ['ano','=', $searchFilters[2]]);
        }

        //    $result =	vwconsanalfest::where($where)->orderBy($searchFilters[0])->get();
        $result =	vwconsanalfest::where($where)->get();


        session(['csvVar' => array('nome_municipio','tanalfabetismo_municipio','ano')]);
        session(['csvTitle' => 'AnafalbetismoEstadual.csv']);
        session(['csvData' => array('Estado','Anafalbetismo','Ano')]);
        session(['csvTable' => $result]);

        return view('searchAnalfEst', ['tables'=>$result]);
    }

    //Relatorio 12
    public function searchHistoricoAnalfEst(Request $request)
    {
        $result1 = vwconsanalfest::where('nome_municipio', $request->input('nome_municipio1'))->get();
        $result2 = vwconsanalfest::where('nome_municipio', $request->input('nome_municipio2'))->get();
        $result3 = vwconsanalfest::where('nome_municipio', $request->input('nome_municipio3'))->get();

        return $this->graficoLEst($result1, $result2, $result3, 'analf', 'Anafalbetismo', 'selectController@searchHistoricoAnalfEst');
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


        session(['csvVar' => array('nome_municipio','trendapercapita_municipio','ano')]);
        session(['csvData' => array('Municipio','Renda Per Capita','Ano')]);
        session(['csvTitle' => 'RendaPerCapitaMunicipal.csv']);
        session(['csvTable' => $result]);
        return view('searchRendaPCapMun', ['tables'=>$result]);
    }

    //Relatorio 14
    public function searchHistoricoRendaPCapMun(Request $request)
    {
        $result1 = vwconsrendapcapmun::where('nome_municipio', $request->input('nome_municipio1'))->get();
        $result2 = vwconsrendapcapmun::where('nome_municipio', $request->input('nome_municipio2'))->get();
        $result3 = vwconsrendapcapmun::where('nome_municipio', $request->input('nome_municipio3'))->get();

        return $this->graficoLMun($result1, $result2, $result3, 'renda', 'Renda Per Capita', 'selectController@searchHistoricoRendaPCapMun');
    }

    //Relatorio 15
    public function searchRendaPCapEst(Request $request)
    {
        $where = array();

        $searchFilters = array(
                        $request->input('nome_municipio'),
                        $request->input('ano'),
                        );

        if ($searchFilters[0] != null) {
            array_push($where, ['nome_municipio','LIKE', '%'.$searchFilters[0].'%']);
        }

        if ($searchFilters[1] != null) {
            array_push($where, ['ano','=', $searchFilters[1]]);
        }

        //$result =	vwconsrendapcapest::where($where)->orderBy($searchFilters[0])->get();
        $result =	vwconsrendapcapest::where($where)->get();


        session(['csvVar' => array('nome_municipio','trendapercapita_municipio','ano')]);
        session(['csvTitle' => 'RendaPerCapitaEstadual.csv']);
        session(['csvData' => array('Estado','Renda Per Capita','Ano')]);
        session(['csvTable' => $result]);

        return view('searchRendaPCapEst', ['tables'=>$result]);
    }

    //Relatorio 16
    public function searchHistoricoRendaPCapEst(Request $request)
    {
        $result1 = vwconsrendapcapest::where('nome_municipio', $request->input('nome_municipio1'))->get();
        $result2 = vwconsrendapcapest::where('nome_municipio', $request->input('nome_municipio2'))->get();
        $result3 = vwconsrendapcapest::where('nome_municipio', $request->input('nome_municipio3'))->get();

        return $this->graficoLEst($result1, $result2, $result3, 'renda', 'Renda Per Capita', 'selectController@searchHistoricoRendaPCapEst');
    }

    public static function getCSV()
    {
        $util = new Util();

        $util->exportToCSV(session('csvTable'), session('csvData'), session('csvTitle'), session('csvVar'));
    }



    public function graficoLEst($result1, $result2, $result3, $taxa, $nomeTaxa, $control)
    {
        $array0 = array("1991");
        $array1 = array("2000");
        $array2 = array("2010");


        $historico = \Lava::DataTable();
        $historico->addDateColumn('Ano')->setDateTimeFormat('Y');

        $mostraGrafico = false;
        $nomeMun = '';

        switch ($taxa) {
              case 'idh':

              if (count($result1) != 0) {
                  array_push($array0, $result1[0]->tidh);
                  array_push($array1, $result1[1]->tidh);
                  array_push($array2, $result1[2]->tidh);
                  $historico->addNumberColumn($result1[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result1[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result1[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }
              if (count($result2) != 0) {
                  array_push($array0, $result2[0]->tidh);
                  array_push($array1, $result2[1]->tidh);
                  array_push($array2, $result2[2]->tidh);
                  $historico->addNumberColumn($result2[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result2[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result2[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }


              if (count($result3) != 0) {
                  array_push($array0, $result3[0]->tidh);
                  array_push($array1, $result3[1]->tidh);
                  array_push($array2, $result3[2]->tidh);
                  $historico->addNumberColumn($result3[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result3[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result3[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }

              break;
              case 'mort':

              if (count($result1) != 0) {
                  array_push($array0, $result1[0]->tmortalidade_municipio);
                  array_push($array1, $result1[1]->tmortalidade_municipio);
                  array_push($array2, $result1[2]->tmortalidade_municipio);
                  $historico->addNumberColumn($result1[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result1[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result1[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }
              if (count($result2) != 0) {
                  array_push($array0, $result2[0]->tmortalidade_municipio);
                  array_push($array1, $result2[1]->tmortalidade_municipio);
                  array_push($array2, $result2[2]->tmortalidade_municipio);
                  $historico->addNumberColumn($result2[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result2[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result2[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }


              if (count($result3) != 0) {
                  array_push($array0, $result3[0]->tmortalidade_municipio);
                  array_push($array1, $result3[1]->tmortalidade_municipio);
                  array_push($array2, $result3[2]->tmortalidade_municipio);
                  $historico->addNumberColumn($result3[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result3[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result3[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }

              break;
              case 'analf':

              if (count($result1) != 0) {
                  array_push($array0, $result1[0]->tanalfabetismo_municipio);
                  array_push($array1, $result1[1]->tanalfabetismo_municipio);
                  array_push($array2, $result1[2]->tanalfabetismo_municipio);
                  $historico->addNumberColumn($result1[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result1[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result1[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }
              if (count($result2) != 0) {
                  array_push($array0, $result2[0]->tanalfabetismo_municipio);
                  array_push($array1, $result2[1]->tanalfabetismo_municipio);
                  array_push($array2, $result2[2]->tanalfabetismo_municipio);
                  $historico->addNumberColumn($result2[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result2[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result2[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }


              if (count($result3) != 0) {
                  array_push($array0, $result3[0]->tanalfabetismo_municipio);
                  array_push($array1, $result3[1]->tanalfabetismo_municipio);
                  array_push($array2, $result3[2]->tanalfabetismo_municipio);
                  $historico->addNumberColumn($result3[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result3[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result3[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }

              // code...
              break;
              case 'renda':

              if (count($result1) != 0) {
                  array_push($array0, $result1[0]->trendapercapita_municipio);
                  array_push($array1, $result1[1]->trendapercapita_municipio);
                  array_push($array2, $result1[2]->trendapercapita_municipio);
                  $historico->addNumberColumn($result1[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result1[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result1[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }
              if (count($result2) != 0) {
                  array_push($array0, $result2[0]->trendapercapita_municipio);
                  array_push($array1, $result2[1]->trendapercapita_municipio);
                  array_push($array2, $result2[2]->trendapercapita_municipio);
                  $historico->addNumberColumn($result2[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result2[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result2[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }


              if (count($result3) != 0) {
                  array_push($array0, $result3[0]->trendapercapita_municipio);
                  array_push($array1, $result3[1]->trendapercapita_municipio);
                  array_push($array2, $result3[2]->trendapercapita_municipio);
                  $historico->addNumberColumn($result3[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result3[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result3[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }

              break;

        default:
          // code...
          break;
      }


        $historico->addRow($array0);
        $historico->addRow($array1);
        $historico->addRow($array2);




        $titulo = 'Titulo';
        if ($mostraGrafico) {
            $titulo = 'Histórico de '.$nomeTaxa .' em '.$nomeMun;
        } else {
            $titulo = '-1';
        }
        \Lava::LineChart('historicoIDHM', $historico, [
            'height' => '300'

      ]);

        return view('historicoIDH', ['control'=>$control,'titulo'=>$titulo]);
    }
    public function graficoLMun($result1, $result2, $result3, $taxa, $nomeTaxa, $control)
    {
        $array0 = array("1991");
        $array1 = array("2000");
        $array2 = array("2010");


        $historico = \Lava::DataTable();
        $historico->addDateColumn('Ano')->setDateTimeFormat('Y');

        $mostraGrafico = false;
        $nomeMun = '';

        switch ($taxa) {
              case 'idh':

              if (count($result1) != 0) {
                  array_push($array0, $result1[0]->tidhm);
                  array_push($array1, $result1[1]->tidhm);
                  array_push($array2, $result1[2]->tidhm);
                  $historico->addNumberColumn($result1[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result1[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result1[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }
              if (count($result2) != 0) {
                  array_push($array0, $result2[0]->tidhm);
                  array_push($array1, $result2[1]->tidhm);
                  array_push($array2, $result2[2]->tidhm);
                  $historico->addNumberColumn($result2[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result2[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result2[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }


              if (count($result3) != 0) {
                  array_push($array0, $result3[0]->tidhm);
                  array_push($array1, $result3[1]->tidhm);
                  array_push($array2, $result3[2]->tidhm);
                  $historico->addNumberColumn($result3[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result3[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result3[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }

              break;
              case 'mort':

              if (count($result1) != 0) {
                  array_push($array0, $result1[0]->tmortalidade_municipio);
                  array_push($array1, $result1[1]->tmortalidade_municipio);
                  array_push($array2, $result1[2]->tmortalidade_municipio);
                  $historico->addNumberColumn($result1[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result1[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result1[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }
              if (count($result2) != 0) {
                  array_push($array0, $result2[0]->tmortalidade_municipio);
                  array_push($array1, $result2[1]->tmortalidade_municipio);
                  array_push($array2, $result2[2]->tmortalidade_municipio);
                  $historico->addNumberColumn($result2[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result2[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result2[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }


              if (count($result3) != 0) {
                  array_push($array0, $result3[0]->tmortalidade_municipio);
                  array_push($array1, $result3[1]->tmortalidade_municipio);
                  array_push($array2, $result3[2]->tmortalidade_municipio);
                  $historico->addNumberColumn($result3[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result3[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result3[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }

              break;
              case 'analf':

              if (count($result1) != 0) {
                  array_push($array0, $result1[0]->tanalfabetismo_municipio);
                  array_push($array1, $result1[1]->tanalfabetismo_municipio);
                  array_push($array2, $result1[2]->tanalfabetismo_municipio);
                  $historico->addNumberColumn($result1[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result1[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result1[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }
              if (count($result2) != 0) {
                  array_push($array0, $result2[0]->tanalfabetismo_municipio);
                  array_push($array1, $result2[1]->tanalfabetismo_municipio);
                  array_push($array2, $result2[2]->tanalfabetismo_municipio);
                  $historico->addNumberColumn($result2[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result2[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result2[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }


              if (count($result3) != 0) {
                  array_push($array0, $result3[0]->tanalfabetismo_municipio);
                  array_push($array1, $result3[1]->tanalfabetismo_municipio);
                  array_push($array2, $result3[2]->tanalfabetismo_municipio);
                  $historico->addNumberColumn($result3[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result3[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result3[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }

              // code...
              break;
              case 'renda':

              if (count($result1) != 0) {
                  array_push($array0, $result1[0]->trendapercapita_municipio);
                  array_push($array1, $result1[1]->trendapercapita_municipio);
                  array_push($array2, $result1[2]->trendapercapita_municipio);
                  $historico->addNumberColumn($result1[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result1[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result1[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }
              if (count($result2) != 0) {
                  array_push($array0, $result2[0]->trendapercapita_municipio);
                  array_push($array1, $result2[1]->trendapercapita_municipio);
                  array_push($array2, $result2[2]->trendapercapita_municipio);
                  $historico->addNumberColumn($result2[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result2[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result2[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }


              if (count($result3) != 0) {
                  array_push($array0, $result3[0]->trendapercapita_municipio);
                  array_push($array1, $result3[1]->trendapercapita_municipio);
                  array_push($array2, $result3[2]->trendapercapita_municipio);
                  $historico->addNumberColumn($result3[0]->nome_municipio);

                  if (!$mostraGrafico) {
                      $nomeMun = $nomeMun . $result3[0]->nome_municipio;  // code...
                  } else {
                      $nomeMun = $nomeMun . " x " . $result3[0]->nome_municipio;
                  }
                  $mostraGrafico = true;
              }

              break;

        default:
          // code...
          break;
      }


        $historico->addRow($array0);
        $historico->addRow($array1);
        $historico->addRow($array2);




        $titulo = 'Titulo';
        if ($mostraGrafico) {
            $titulo = 'Histórico de '.$nomeTaxa .' em '.$nomeMun;
        } else {
            $titulo = '-1';
        }
        \Lava::LineChart('historicoIDHM', $historico, [
            'height' => '300'

      ]);

        return view('historicoMun', ['control'=>$control,'titulo'=>$titulo]);
    }

    public function geoEstadual(Request $request)
    {
        $result = array();
        $geoGraph = \Lava::DataTable();
        $mostraGrafico = true;
        $titulo = 'null';

        switch ($request->input('indice')) {
        case 'idh':
          $result = vwhistoricoidh::where('ano', $request->input('ano'))->get();
          $titulo = 'IDH';
          $geoGraph->addStringColumn('Estado')
                   ->addNumberColumn('IDH');

         foreach ($result as $row) {
             $geoGraph->addRow(array($row->nome_municipio, $row->tidh));
         }
         break;

          case 'analf':
            $result = vwconsanalfest::where('ano', $request->input('ano'))->get();
            $titulo = 'Anafalbetismo';


                    $geoGraph->addStringColumn('Estado')
                     ->addNumberColumn('Anafalbetismo');

                     foreach ($result as $row) {
                         $geoGraph->addRow(array($row->nome_municipio, $row->tanalfabetismo_municipio));
                     }
            break;

            case 'mort':
              $result = vwconsmortest::where('ano', $request->input('ano'))->get();
              $titulo = 'Mortalidade';


                      $geoGraph->addStringColumn('Estado')
                       ->addNumberColumn('Mortalidade');

                       foreach ($result as $row) {
                           $geoGraph->addRow(array($row->nome_municipio, $row->tmortalidade_municipio));
                       }
              break;

              case 'renda':
                $result = vwconsrendapcapest::where('ano', $request->input('ano'))->get();
                $titulo = 'Renda Per Capita';


                        $geoGraph->addStringColumn('Estado')
                         ->addNumberColumn('RendaPerCapita');

                         foreach ($result as $row) {
                             $geoGraph->addRow(array($row->nome_municipio, $row->trendapercapita_municipio));
                         }
                break;

        default:
          $mostraGrafico = false;
          break;
      }
        \Lava::GeoChart('Popularity', $geoGraph, [
      'region' => 'BR',
      'resolution' => 'provinces',

      ]);
        return view('geoEstadual', ['mostraGrafico' => $mostraGrafico, 'titulo' => $titulo,'ano' => $request->input('ano')]);
    }
}
