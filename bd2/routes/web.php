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
Route::get('/searchIDHM/{search?}','selectController@searchIDHM')->name('selectRoute');
//Relatorio 2
Route::get('/searchHistoricoIDHM/{nomeMunicipio?}','selectController@searchHistoricoIDHM');
//Relatorio 3
Route::get('/searchIDH/{search?}','selectController@searchIDH')->name('selectRoute');
//Relatorio 4
Route::get('/searchHistoricoIDH/{nomeEstado?}','selectController@searchHistoricoIDH');
//Relatorio 5
Route::get('/searchMortMun/{search?}','selectController@searchMortMun');
//Relatorio 6
Route::get('/searchHistoricoMortMun/{nomeMunicipio?}','selectController@searchHistoricoMortMun');
//Relatorio 7
Route::get('/searchMortEst/{search?}','selectController@searchMortEst');
//Relatorio 8
Route::get('/searchHistoricoMortEst/{nomeEstado?}','selectController@searchHistoricoMortEst');
//Relatorio 9
Route::get('/searchAnalfMun/{search?}','selectController@searchAnalfMun');
//Relatorio 10
Route::get('/searchHistoricoAnalfMun/{nomeMunicipio?}','selectController@searchHistoricoAnalfMun');
//Relatorio 11
Route::get('/searchAnalfEst/{search?}','selectController@searchAnalfEst');
//Relatorio 12
Route::get('/searchHistoricoAnalEst/{nomeEstado?}','selectController@searchHistoricoAnalfEst');
//Relatorio 13
Route::get('/searchRendaPCapMun/{search?}','selectController@searchRendaPCapMun');
//Relatorio 14
Route::get('/searchHistoricoRendaPCapMun/{nomeMunicipio?}','selectController@searchHistoricoRendaPCapMun');
//Relatorio 15
Route::get('/searchRendaPCapEst/{search?}','selectController@searchAnalfEst');
//Relatorio 16
Route::get('/searchHistoricoRendaPCapEst/{nomeEstado?}','selectController@searchHistoricoRendaPCapEst');
