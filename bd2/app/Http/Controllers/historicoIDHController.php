<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class historicoIDHController extends Controller
{
    public function index(Request $request)
    {
        $historico = \Lava::DataTable();


        $historico->addDateColumn('Year')
           ->addNumberColumn('IDH')
           ->setDateTimeFormat('Y')
           ->addRow(array("2010", 100))
           ->addRow(array("2011", 200))
           ->addRow(array("2012", 300));


        \Lava::LineChart('historicoIDH', $historico, [
          'title' => 'Historico de IDH'

        ]);
        return view('historicoIDHView');

    }

}
