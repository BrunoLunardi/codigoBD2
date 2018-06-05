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
