<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class geoController extends Controller
{
    public function index(Request $request)
    {
        $popularity = \Lava::DataTable();


        $popularity->addStringColumn('Country')
           ->addNumberColumn('Popularity')
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
}
