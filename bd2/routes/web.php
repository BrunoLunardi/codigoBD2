<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    $results = DB::select('select * from estado');

    foreach ($results as $table) {
        foreach ($table as $tupla) {
            echo $tupla," ";
        }
        echo "<br>";
    }
    return view('welcome');
});

Route::get('/teste/{auxiliar?}','selectController@teste');
Route::get('/showTable/{tName?}','selectController@index');

//Relatorio 1
Route::any('/searchIDHM/','selectController@searchIDHM');
//Relatorio 2
Route::any('/historicoIDHM/','selectController@searchHistoricoIDHM');
//Relatorio 3
Route::any('/searchIDH/','selectController@searchIDH');
//Relatorio 4
Route::any('/searchHistoricoIDH/','selectController@searchHistoricoIDH');
//Relatorio 5
Route::any('/searchMortMun/','selectController@searchMortMun');
//Relatorio 6
Route::any('/searchHistoricoMortMun/','selectController@searchHistoricoMortMun');
//Relatorio 7
Route::any('/searchMortEst/','selectController@searchMortEst');
//Relatorio 8
Route::any('/searchHistoricoMortEst/','selectController@searchHistoricoMortEst');
//Relatorio 9
Route::any('/searchAnalfMun/','selectController@searchAnalfMun');
//Relatorio 10
Route::any('/searchHistoricoAnalfMun/','selectController@searchHistoricoAnalfMun');
//Relatorio 11
Route::any('/searchAnalfEst/','selectController@searchAnalfEst');
//Relatorio 12
Route::any('/searchHistoricoAnalfEst/','selectController@searchHistoricoAnalfEst');
//Relatorio 13
Route::any('/searchRendaPCapMun/','selectController@searchRendaPCapMun');
//Relatorio 14
Route::any('/searchHistoricoRendaPCapMun/','selectController@searchHistoricoRendaPCapMun');
//Relatorio 15
Route::any('/searchRendaPCapEst/','selectController@searchRendaPCapEst');
//Relatorio 16
Route::any('/searchHistoricoRendaPCapEst/','selectController@searchHistoricoRendaPCapEst');
