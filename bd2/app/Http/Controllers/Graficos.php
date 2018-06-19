<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class Graficos extends Controller
{
    public function graficoGeo(Request $dados)
    {
        $popularity = \Lava::DataTable();


        $popularity->addStringColumn('Country')
           ->addNumberColumn('IDH')
           ->addRow(array('São Paulo', 100))
           ->addRow(array('Amapá', 200))
           ->addRow(array('Amazonas', 300))
           ->addRow(array('Acre', 400))
           ->addRow(array('Rio de Janeiro', 700));
        \Lava::GeoChart('Popularity', $popularity, [
        'region' => 'BR',
        'resolution' => 'provinces',

        ]);
        return view('geoView');

    }


        public function graficoLinha($dados)
        {
            $historico = \Lava::DataTable();


            $historico->addDateColumn('Year')
               ->addNumberColumn('IDH')
               ->addRow(array('2010', 100))
               ->addRow(array('2011', 200))
               ->addRow(array('2012', 300))
               ->setDateTimeFormat('y');


            \Lava::LineChart('historicoIDH', $historico, [
              'title' => 'Historico de IDH'
            ]);
            return view('historicoIDHView');
        }

}
